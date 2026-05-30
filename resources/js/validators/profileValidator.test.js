import { describe, it, expect } from 'vitest'
import { profileValidator } from '@/validators/profileValidator'

describe('profileValidator', () => {
    it('should return error when name is missing', () => {
        const result = profileValidator({
            values: {
                email: 'johnny.cash@example.com',
            },
        })

        expect(result.errors).toEqual({
            name: [{ message: 'Name is required.' }],
        })
    })

    it('should return error when email is missing', () => {
        const result = profileValidator({
            values: {
                name: 'Johnny Cash',
            },
        })

        expect(result.errors).toEqual({
            email: [{ message: 'Email is required.' }],
        })
    })

    it('should return error when email format is invalid', () => {
        const result = profileValidator({
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

        const result = profileValidator({
            values,
        })

        expect(result.errors).toEqual({})
        expect(result.values).toEqual(values)
    })
})
