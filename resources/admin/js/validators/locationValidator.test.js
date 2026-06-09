import { describe, it, expect } from 'vitest'
import { locationValidator } from '@admin/validators/locationValidator'

describe('locationValidator', () => {
    const validValues = {
        name: 'Prague Old Town Center',
        city_country: 'Prague cz',
        address: 'Old Town Square, Prague',
        type: 'city_center',
        phone: '+4205553002',
        email: 'prague-center@example.com',
        description: 'City center office in Prague.',
        active: true,
    }

    it('returns no errors for valid values', () => {
        const result = locationValidator({ values: validValues })

        expect(result.errors).toEqual({})
    })

    it('requires name', () => {
        const result = locationValidator({
            values: {
                ...validValues,
                name: '',
            },
        })

        expect(result.errors.name).toEqual([{ message: 'Location name is required.' }])
    })

    it('requires city and country', () => {
        const result = locationValidator({
            values: {
                ...validValues,
                city_country: '',
            },
        })

        expect(result.errors.city_country).toEqual([{ message: 'City and Country is required.' }])
    })

    it('requires address', () => {
        const result = locationValidator({
            values: {
                ...validValues,
                address: '',
            },
        })

        expect(result.errors.address).toEqual([{ message: 'Address is required.' }])
    })

    it('requires type', () => {
        const result = locationValidator({
            values: {
                ...validValues,
                type: '',
            },
        })

        expect(result.errors.type).toEqual([{ message: 'Type is required.' }])
    })

    it('requires phone', () => {
        const result = locationValidator({
            values: {
                ...validValues,
                phone: '',
            },
        })

        expect(result.errors.phone).toEqual([{ message: 'Phone is required.' }])
    })

    it('should return error when email is missing', () => {
        const result = locationValidator({
            values: {
                ...validValues,
                email: '',
            },
        })

        expect(result.errors).toEqual({
            email: [{ message: 'Email is required.' }],
        })
    })

    it('should return error when email format is invalid', () => {
        const result = locationValidator({
            values: {
                ...validValues,
                email: 'invalid-email',
            },
        })

        expect(result.errors).toEqual({
            email: [{ message: 'Invalid email address.' }],
        })
    })

    it('should not return errors for valid email', () => {
        const values = {
            ...validValues,
            email: 'john.doe@example.com',
        }

        const result = locationValidator({
            values,
        })

        expect(result.errors).toEqual({})
        expect(result.values).toEqual(values)
    })
})
