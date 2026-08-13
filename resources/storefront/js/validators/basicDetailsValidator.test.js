import { describe, it, expect } from 'vitest'
import { basicDetailsValidator } from '@storefront/validators/basicDetailsValidator'

describe('basicDetailsValidator', () => {
    const validValues = {
        firstName: 'John',
        lastName: 'Doe',
        phone: '+36 30 123 4567',
        email: 'john@example.com',
    }

    it('returns no errors for valid values', () => {
        const result = basicDetailsValidator({
            values: validValues,
        })

        expect(result.errors).toEqual({})
        expect(result.values).toEqual(validValues)
    })

    it('requires first name', () => {
        const result = basicDetailsValidator({
            values: {
                ...validValues,
                firstName: '',
            },
        })

        expect(result.errors.firstName).toEqual([{ message: 'First name is required.' }])
    })

    it('requires last name', () => {
        const result = basicDetailsValidator({
            values: {
                ...validValues,
                lastName: '',
            },
        })

        expect(result.errors.lastName).toEqual([{ message: 'Last name is required.' }])
    })

    it('requires phone number', () => {
        const result = basicDetailsValidator({
            values: {
                ...validValues,
                phone: '',
            },
        })

        expect(result.errors.phone).toEqual([{ message: 'Phone number is required.' }])
    })

    it('requires email', () => {
        const result = basicDetailsValidator({
            values: {
                ...validValues,
                email: '',
            },
        })

        expect(result.errors.email).toEqual([{ message: 'Email is required.' }])
    })

    it('validates email format', () => {
        const result = basicDetailsValidator({
            values: {
                ...validValues,
                email: 'invalid-email',
            },
        })

        expect(result.errors.email).toEqual([{ message: 'Invalid email address.' }])
    })
})
