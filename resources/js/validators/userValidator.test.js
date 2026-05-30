import { describe, it, expect } from 'vitest'
import { userValidator } from '@/validators/userValidator'

describe('userValidator', () => {
    it('should return error when name is missing', () => {
        const result = userValidator({
            values: {
                email: 'johnny.cash@example.com',
            },
        })

        expect(result.errors).toEqual({
            name: [{ message: 'Name is required.' }],
        })
    })

    it('should return error when email is missing', () => {
        const result = userValidator({
            values: {
                name: 'Johnny Cash',
            },
        })

        expect(result.errors).toEqual({
            email: [{ message: 'Email is required.' }],
        })
    })

    it('should return error when email format is invalid', () => {
        const result = userValidator({
            values: {
                name: 'Johnny Cash',
                email: 'invalid-email',
            },
        })

        expect(result.errors).toEqual({
            email: [{ message: 'Invalid email address.' }],
        })
    })

    it('should not return errors for valid email', () => {
        const values = {
            name: 'Johnny Cash',
            email: 'john.doe@example.com',
        }

        const result = userValidator({
            values,
        })

        expect(result.errors).toEqual({})
        expect(result.values).toEqual(values)
    })
})
