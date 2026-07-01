import { describe, it, expect } from 'vitest'
import { registerValidator } from '@storefront/validators/registerValidator'

describe('registerValidator', () => {
    const validValues = {
        name: 'Test User',
        phone: '123 456 789',
        email: 'test@example.com',
        password: 'password123',
        password_confirmation: 'password123',
    }

    it('should return error when name is missing', () => {
        const result = registerValidator({
            values: {
                ...validValues,
                name: '',
            },
        })

        expect(result.errors.name).toEqual([{ message: 'Name is required.' }])
    })

    it('should return error when phone is missing', () => {
        const result = registerValidator({
            values: {
                ...validValues,
                phone: '',
            },
        })

        expect(result.errors.phone).toEqual([{ message: 'Phone number is required.' }])
    })

    it('should require email', () => {
        const result = registerValidator({
            values: {
                ...validValues,
                email: '',
            },
        })

        expect(result.errors.email).toEqual([{ message: 'Email is required.' }])
    })

    it('should validate email format', () => {
        const result = registerValidator({
            values: {
                ...validValues,
                email: 'invalid-email',
            },
        })

        expect(result.errors.email).toEqual([{ message: 'Email is invalid.' }])
    })

    it('should return no errors for valid input', () => {
        const result = registerValidator({
            values: validValues,
        })

        expect(result.errors).toEqual({})
        expect(result.values).toEqual(validValues)
    })

    it('should require password', () => {
        const result = registerValidator({
            values: {
                ...validValues,
                password: '',
            },
        })

        expect(result.errors.password).toEqual([{ message: 'Password is required.' }])
    })

    it('should validate minimum password length', () => {
        const result = registerValidator({
            values: {
                ...validValues,
                password: '1234567',
                password_confirmation: '1234567',
            },
        })

        expect(result.errors.password).toEqual([
            { message: 'Password must be at least 8 characters long.' },
        ])
    })

    it('should require password confirmation', () => {
        const result = registerValidator({
            values: {
                ...validValues,
                password_confirmation: '',
            },
        })

        expect(result.errors.password_confirmation).toEqual([
            { message: 'The password field confirmation does not match.' },
        ])
    })

    it('should validate minimum confirmation length', () => {
        const result = registerValidator({
            values: {
                ...validValues,
                password: '1234567',
                password_confirmation: '1234567',
            },
        })

        expect(result.errors.password_confirmation).toEqual([
            { message: 'Password again must be at least 8 characters long.' },
        ])
    })

    it('should validate password confirmation match', () => {
        const result = registerValidator({
            values: {
                ...validValues,
                password_confirmation: 'password456',
            },
        })

        expect(result.errors.password_confirmation).toEqual([
            {
                message: 'The password field confirmation does not match.',
            },
        ])
    })

    it('should return no errors for valid input', () => {
        const result = registerValidator({
            values: validValues,
        })

        expect(result.errors).toEqual({})
        expect(result.values).toEqual(validValues)
    })
})
