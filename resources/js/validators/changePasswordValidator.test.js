import { describe, it, expect } from 'vitest'
import { changePasswordValidator } from '@/validators/changePasswordValidator'

describe('changePasswordValidator', () => {
    it('returns no errors for valid data', () => {
        const values = {
            current_password: 'oldpassword',
            password: 'newpassword123',
            password_confirmation: 'newpassword123',
        }

        const result = changePasswordValidator({ values })

        expect(result.errors).toEqual({})
    })

    it('requires current password', () => {
        const values = {
            current_password: '',
            password: 'newpassword123',
            password_confirmation: 'newpassword123',
        }

        const result = changePasswordValidator({ values })

        expect(result.errors.current_password).toEqual([
            { message: 'Current password is required.' },
        ])
    })

    it('requires password', () => {
        const values = {
            current_password: 'oldpassword',
            password: '',
            password_confirmation: 'newpassword123',
        }

        const result = changePasswordValidator({ values })

        expect(result.errors.password).toEqual([{ message: 'Password is required.' }])
    })

    it('requires password to be at least 8 characters', () => {
        const values = {
            current_password: 'oldpassword',
            password: 'short',
            password_confirmation: 'short',
        }

        const result = changePasswordValidator({ values })

        expect(result.errors.password).toEqual([
            { message: 'Password must be at least 8 characters long.' },
        ])
    })

    it('requires password confirmation', () => {
        const values = {
            current_password: 'oldpassword',
            password: 'newpassword123',
            password_confirmation: '',
        }

        const result = changePasswordValidator({ values })

        expect(result.errors.password_confirmation).toEqual([
            { message: 'Password again is required.' },
        ])
    })

    it('requires matching passwords', () => {
        const values = {
            current_password: 'oldpassword',
            password: 'newpassword123',
            password_confirmation: 'differentpassword123',
        }

        const result = changePasswordValidator({ values })

        expect(result.errors.password_confirmation).toEqual([
            { message: 'The password field confirmation does not match.' },
        ])
    })
})
