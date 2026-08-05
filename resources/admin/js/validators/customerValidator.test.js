import { describe, it, expect } from 'vitest'
import { customerValidator } from '@admin/validators/customerValidator'

describe('customerValidator', () => {
    const validValues = {
        name: 'John Doe',
        email: 'john.doe@example.com',
    }

    it('returns no errors for valid values', () => {
        const result = customerValidator({ values: validValues })

        expect(result.errors).toEqual({})
    })

    it('should return error when name is missing', () => {
        const result = customerValidator({
            values: {},
        })

        expect(result.errors.name).toEqual([{ message: 'Name is required.' }])
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
