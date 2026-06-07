import { describe, it, expect } from 'vitest'
import { loginValidator } from '@/validators/loginValidator'

describe('loginValidator', () => {
    const validValues = {
        email: 'john@example.com',
        password: 'password123',
    }

    it('returns no errors for valid credentials', () => {
        const result = loginValidator({
            values: validValues,
        })

        expect(result.errors).toEqual({})
    })

    it('requires email', () => {
        const result = loginValidator({
            values: {
                ...validValues,
                email: '',
            },
        })

        expect(result.errors.email).toEqual([{ message: 'Email is required.' }])
    })

    it('requires a valid email address', () => {
        const result = loginValidator({
            values: {
                ...validValues,
                email: 'invalid-email',
            },
        })

        expect(result.errors.email).toEqual([{ message: 'Invalid email address.' }])
    })

    it('requires password', () => {
        const result = loginValidator({
            values: {
                ...validValues,
                password: '',
            },
        })

        expect(result.errors.password).toEqual([{ message: 'Password is required.' }])
    })

    it('returns both email and password errors when both fields are empty', () => {
        const result = loginValidator({
            values: {
                ...validValues,
                email: '',
                password: '',
            },
        })

        expect(result.errors).toEqual({
            email: [{ message: 'Email is required.' }],
            password: [{ message: 'Password is required.' }],
        })
    })

    it('does not validate email format when email is empty', () => {
        const result = loginValidator({
            values: {
                ...validValues,
                email: '',
            },
        })

        expect(result.errors.email).toEqual([{ message: 'Email is required.' }])
    })
})
