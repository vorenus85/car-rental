import { describe, it, expect } from 'vitest'
import { customerValidator } from '@admin/validators/customerValidator'

describe('customerValidator', () => {
    const validValues = {
        firstName: 'John',
        lastName: 'Doe',
        email: 'john.doe@example.com',
    }

    it('returns no errors for valid values', () => {
        const result = customerValidator({ values: validValues })

        expect(result.errors).toEqual({})
    })

    it('should return error when firstName is missing', () => {
        const result = customerValidator({
            values: {},
        })

        expect(result.errors.firstName).toEqual([{ message: 'First name is required.' }])
    })

    it('should return error when lastName is missing', () => {
        const result = customerValidator({
            values: {},
        })

        expect(result.errors.lastName).toEqual([{ message: 'Last name is required.' }])
    })

    it('should return error when email is missing', () => {
        const result = customerValidator({
            values: {
                ...validValues,
                email: '',
            },
        })

        expect(result.errors.email).toEqual([{ message: 'Email is required.' }])
    })

    it('should return error when email format is invalid', () => {
        const result = customerValidator({
            values: {
                ...validValues,
                email: 'invalid-email',
            },
        })

        expect(result.errors.email).toEqual([{ message: 'Invalid email address.' }])
    })
})
