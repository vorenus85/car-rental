import { describe, it, expect } from 'vitest'
import { addressValidator } from '@storefront/validators/addressValidator'

describe('addressValidator', () => {
    const validValues = {
        country: 'HU',
        city: 'Budapest',
        postalCode: '1051',
        addressLine1: '123 Main St',
    }

    it('should return no errors for valid input', () => {
        const result = addressValidator({
            values: validValues,
        })

        expect(result.errors).toEqual({})
        expect(result.values).toEqual(validValues)
    })

    it('should return error when country is missing', () => {
        const result = addressValidator({
            values: {
                ...validValues,
                country: '',
            },
        })

        expect(result.errors.country).toEqual([{ message: 'Country is required.' }])
    })

    it('should return error when city is missing', () => {
        const result = addressValidator({
            values: {
                ...validValues,
                city: '',
            },
        })

        expect(result.errors.city).toEqual([{ message: 'City is required.' }])
    })

    it('should return error when postalCode is missing', () => {
        const result = addressValidator({
            values: {
                ...validValues,
                postalCode: '',
            },
        })

        expect(result.errors.postalCode).toEqual([{ message: 'Postal code is required.' }])
    })

    it('should return error when addressLine1 is missing', () => {
        const result = addressValidator({
            values: {
                ...validValues,
                addressLine1: '',
            },
        })

        expect(result.errors.addressLine1).toEqual([{ message: 'Address line 1 is required.' }])
    })
})
