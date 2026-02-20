import { describe, it, expect, vi, beforeEach } from 'vitest'
import { useAuth } from './useAuth'

describe('useAuth - loginValidator', () => {
    const { loginValidator } = useAuth()

    beforeEach(() => {
        vi.spyOn(window, 'scrollTo').mockImplementation(() => {})
    })

    it('returns error when email is missing', () => {
        const result = loginValidator({
            values: { email: '', password: '123456' },
        })

        expect(result.errors.email[0].message).toBe('Email is required.')
    })

    it('returns error when email is invalid', () => {
        const result = loginValidator({
            values: { email: 'invalid-email', password: '123456' },
        })

        expect(result.errors.email[0].message).toBe('Invalid email address.')
    })

    it('returns error when password is missing', () => {
        const result = loginValidator({
            values: { email: 'test@test.com', password: '' },
        })

        expect(result.errors.password[0].message).toBe('Password is required.')
    })

    it('returns no errors for valid input', () => {
        const result = loginValidator({
            values: { email: 'test@test.com', password: '123456' },
        })

        expect(result.errors).toEqual({})
    })
})
