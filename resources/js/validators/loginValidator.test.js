import { describe, it, expect } from 'vitest'
import { loginValidator } from '@/validators/loginValidator'

describe('loginValidator', () => {
    it('returns no errors for valid credentials', () => {
        const values = {
            email: 'john@example.com',
            password: 'password123',
        }

        const result = loginValidator({ values })

        expect(result.errors).toEqual({})
    })

    it('requires email', () => {
        const values = {
            email: '',
            password: 'password123',
        }

        const result = loginValidator({ values })

        expect(result.errors.email).toEqual([{ message: 'Email is required.' }])
    })

    it('requires a valid email address', () => {
        const values = {
            email: 'invalid-email',
            password: 'password123',
        }

        const result = loginValidator({ values })

        expect(result.errors.email).toEqual([{ message: 'Invalid email address.' }])
    })

    it('requires password', () => {
        const values = {
            email: 'john@example.com',
            password: '',
        }

        const result = loginValidator({ values })

        expect(result.errors.password).toEqual([{ message: 'Password is required.' }])
    })

    it('returns both email and password errors when both fields are empty', () => {
        const values = {
            email: '',
            password: '',
        }

        const result = loginValidator({ values })

        expect(result.errors).toEqual({
            email: [{ message: 'Email is required.' }],
            password: [{ message: 'Password is required.' }],
        })
    })

    it('does not validate email format when email is empty', () => {
        const values = {
            email: '',
            password: 'password123',
        }

        const result = loginValidator({ values })

        expect(result.errors.email).toEqual([{ message: 'Email is required.' }])
    })
})
