import { describe, it, expect } from 'vitest'
import { forgotPasswordValidator } from '@storefront/validators/forgotPasswordValidator'

describe('forgotPasswordValidator', () => {
    const validValues = {
        email: 'john.doe@example.com',
    }

    it('should return error when email is missing', () => {
        const result = forgotPasswordValidator({
            values: {
                ...validValues,
                email: '',
            },
        })

        expect(result.errors.email).toEqual([{ message: 'Email is required.' }])
    })

    it('should return error when email format is invalid', () => {
        const result = forgotPasswordValidator({
            values: {
                ...validValues,
                email: 'invalid-email',
            },
        })

        expect(result.errors.email).toEqual([{ message: 'Invalid email address.' }])
    })

    it('should not return errors for valid email', () => {
        const result = forgotPasswordValidator({
            values: validValues,
        })

        expect(result.errors).toEqual({})
        expect(result.values).toEqual(validValues)
    })

    it('should preserve original values', () => {
        const values = {
            ...validValues,
            extraField: 'test',
        }

        const result = forgotPasswordValidator({
            values,
        })

        expect(result.values).toEqual(values)
    })
})
