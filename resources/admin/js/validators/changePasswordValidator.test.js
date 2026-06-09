import { describe, it, expect } from 'vitest'
import { changePasswordValidator } from '@admin/validators/changePasswordValidator'

describe('changePasswordValidator', () => {
    const validValues = {
        current_password: 'oldpassword',
        password: 'newpassword123',
        password_confirmation: 'newpassword123',
    }

    it('returns no errors for valid data', () => {
        const result = changePasswordValidator({ values: validValues })

        expect(result.errors).toEqual({})
    })

    it('requires current password', () => {
        const result = changePasswordValidator({ values: { ...validValues, current_password: '' } })

        expect(result.errors.current_password).toEqual([
            { message: 'Current password is required.' },
        ])
    })

    it('requires password', () => {
        const result = changePasswordValidator({ values: { ...validValues, password: '' } })

        expect(result.errors.password).toEqual([{ message: 'Password is required.' }])
    })

    it('requires password to be at least 8 characters', () => {
        const result = changePasswordValidator({ values: { ...validValues, password: 'short' } })

        expect(result.errors.password).toEqual([
            { message: 'Password must be at least 8 characters long.' },
        ])
    })

    it('requires password confirmation', () => {
        const result = changePasswordValidator({
            values: { ...validValues, password_confirmation: '' },
        })

        expect(result.errors.password_confirmation).toEqual([
            { message: 'Password again is required.' },
        ])
    })

    it('requires matching passwords', () => {
        const result = changePasswordValidator({
            values: { ...validValues, password_confirmation: 'differentpassword123' },
        })

        expect(result.errors.password_confirmation).toEqual([
            { message: 'The password field confirmation does not match.' },
        ])
    })
})
