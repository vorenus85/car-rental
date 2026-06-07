import { describe, it, expect } from 'vitest'
import { resetPasswordValidator } from '@/validators/resetPasswordValidator'

describe('resetPasswordValidator', () => {
    const validValues = {
        email: 'test@example.com',
        password: 'password123',
        password_confirmation: 'password123',
    }

    it('should require email', () => {
        const result = resetPasswordValidator({
            values: {
                ...validValues,
                email: '',
            },
        })

        expect(result.errors.email).toEqual([{ message: 'Email is required.' }])
    })

    it('should validate email format', () => {
        const result = resetPasswordValidator({
            values: {
                ...validValues,
                email: 'invalid-email',
            },
        })

        expect(result.errors.email).toEqual([{ message: 'Email is invalid.' }])
    })

    it('should require password', () => {
        const result = resetPasswordValidator({
            values: {
                ...validValues,
                password: '',
            },
        })

        expect(result.errors.password).toEqual([{ message: 'Password is required.' }])
    })

    it('should validate minimum password length', () => {
        const result = resetPasswordValidator({
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
        const result = resetPasswordValidator({
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
        const result = resetPasswordValidator({
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
        const result = resetPasswordValidator({
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
        const result = resetPasswordValidator({
            values: validValues,
        })

        expect(result.errors).toEqual({})
        expect(result.values).toEqual(validValues)
    })
})
