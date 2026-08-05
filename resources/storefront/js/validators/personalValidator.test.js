import { describe, it, expect } from 'vitest'
import { personalValidator } from '@storefront/validators/personalValidator'

describe('personalValidator', () => {
    const validValues = {
        firstName: 'John',
        lastName: 'Perge',
        phone: '06-12-3456789',
        birthDate: '1990-01-01',
        email: 'example@example.com',
    }

    it('should return no errors for valid input', () => {
        const result = personalValidator({
            values: validValues,
        })

        expect(result.errors).toEqual({})
        expect(result.values).toEqual(validValues)
    })

    it('should return error when firstName is missing', () => {
        const result = personalValidator({
            values: {
                ...validValues,
                firstName: '',
            },
        })

        expect(result.errors.firstName).toEqual([{ message: 'First name is required.' }])
    })

    it('should return error when lastName is missing', () => {
        const result = personalValidator({
            values: {
                ...validValues,
                lastName: '',
            },
        })

        expect(result.errors.lastName).toEqual([{ message: 'Last name is required.' }])
    })

    it('should return error when phone is missing', () => {
        const result = personalValidator({
            values: {
                ...validValues,
                phone: '',
            },
        })

        expect(result.errors.phone).toEqual([{ message: 'Phone number is required.' }])
    })

    it('should return error when birthDate is missing', () => {
        const result = personalValidator({
            values: {
                ...validValues,
                birthDate: '',
            },
        })

        expect(result.errors.birthDate).toEqual([{ message: 'Birth date is required.' }])
    })

    it('should return error when email is missing', () => {
        const result = personalValidator({
            values: {
                ...validValues,
                email: '',
            },
        })

        expect(result.errors.email).toEqual([{ message: 'Email is required.' }])
    })

    it('should validate email format', () => {
        const result = personalValidator({
            values: {
                ...validValues,
                email: 'invalid-email',
            },
        })

        expect(result.errors.email).toEqual([{ message: 'Invalid email address.' }])
    })
})
