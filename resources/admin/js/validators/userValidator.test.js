import { describe, it, expect } from 'vitest'
import { userValidator } from '@admin/validators/userValidator'

describe('userValidator', () => {
    const validValues = {
        name: 'Johnny Cash',
        email: 'john.doe@example.com',
    }

    it('should return error when name is missing', () => {
        const result = userValidator({
            values: {
                ...validValues,
                name: '',
            },
        })

        expect(result.errors.name).toEqual([{ message: 'Name is required.' }])
    })

    it('should return error when email is missing', () => {
        const result = userValidator({
            values: {
                ...validValues,
                email: '',
            },
        })

        expect(result.errors.email).toEqual([{ message: 'Email is required.' }])
    })

    it('should return error when email format is invalid', () => {
        const result = userValidator({
            values: {
                ...validValues,
                email: 'invalid-email',
            },
        })

        expect(result.errors.email).toEqual([{ message: 'Invalid email address.' }])
    })

    it('should not return errors for valid values', () => {
        const result = userValidator({
            values: validValues,
        })

        expect(result.errors).toEqual({})
        expect(result.values).toEqual(validValues)
    })
})
