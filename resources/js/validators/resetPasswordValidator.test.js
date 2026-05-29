import { describe, it, expect } from 'vitest'
import { resetPasswordValidator } from '@/validators/resetPasswordValidator'

describe('resetPasswordValidator', () => {
    it('should require email', () => {
        const result = resetPasswordValidator({
            values: {},
        })

        expect(result.errors.email).toEqual([{ message: 'Email is required.' }])
    })

    it('should validate email format', () => {
        const result = resetPasswordValidator({
            values: {
                email: 'invalid-email',
            },
        })

        expect(result.errors.email).toEqual([{ message: 'Email is invalid.' }])
    })

    it('should require password', () => {
        const result = resetPasswordValidator({
            values: {
                email: 'test@example.com',
            },
        })

        expect(result.errors.password).toEqual([{ message: 'Password is required.' }])
    })

    it('should validate minimum password length', () => {
        const result = resetPasswordValidator({
            values: {
                email: 'test@example.com',
                password: '1234567',
                password_confirmation: '1234567',
            },
        })

        expect(result.errors.password).toEqual([
            { message: 'Password must be at least 8 characters long.' },
        ])
    })

    it('should require password confirmation', () => {
        const result = resetPasswordValidator({
            values: {
                email: 'test@example.com',
                password: 'password123',
            },
        })

        expect(result.errors.password_confirmation).toEqual([
            { message: 'The password field confirmation does not match.' },
        ])
    })

    it('should validate minimum confirmation length', () => {
        const result = resetPasswordValidator({
            values: {
                email: 'test@example.com',
                password: '1234567',
                password_confirmation: '1234567',
            },
        })

        expect(result.errors.password_confirmation).toEqual([
            { message: 'Password again must be at least 8 characters long.' },
        ])
    })

    it('should validate password confirmation match', () => {
        const result = resetPasswordValidator({
            values: {
                email: 'test@example.com',
                password: 'password123',
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
        const values = {
            email: 'test@example.com',
            password: 'password123',
            password_confirmation: 'password123',
        }

        const result = resetPasswordValidator({
            values,
        })

        expect(result.errors).toEqual({})
        expect(result.values).toEqual(values)
    })
})
