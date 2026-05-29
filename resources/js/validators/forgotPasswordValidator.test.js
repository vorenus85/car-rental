import { describe, it, expect } from 'vitest'
import { forgotPasswordValidator } from '@/validators/forgotPasswordValidator'

describe('forgotPasswordValidator', () => {
    it('should return error when email is missing', () => {
        const result = forgotPasswordValidator({
            values: {},
        })

        expect(result.errors).toEqual({
            email: [{ message: 'Email is required.' }],
        })
    })

    it('should return error when email format is invalid', () => {
        const result = forgotPasswordValidator({
            values: {
                email: 'invalid-email',
            },
        })

        expect(result.errors).toEqual({
            email: [{ message: 'Invalid email address.' }],
        })
    })

    it('should not return errors for valid email', () => {
        const values = {
            email: 'john.doe@example.com',
        }

        const result = forgotPasswordValidator({
            values,
        })

        expect(result.errors).toEqual({})
        expect(result.values).toEqual(values)
    })

    it('should preserve original values', () => {
        const values = {
            email: 'test@example.com',
            extraField: 'test',
        }

        const result = forgotPasswordValidator({
            values,
        })

        expect(result.values).toEqual(values)
    })
})
