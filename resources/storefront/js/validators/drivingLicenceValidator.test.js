import { describe, it, expect } from 'vitest'
import { drivingLicenceValidator } from '@storefront/validators/drivingLicenceValidator'

describe('drivingLicenceValidator', () => {
    const validValues = {
        licenceNumber: 'HU-123456789',
        issuingCountry: 'HU',
        issueDate: '2000-01-01',
        expiryDate: '2030-01-01',
    }

    it('should return no errors for valid input', () => {
        const result = drivingLicenceValidator({
            values: validValues,
        })

        expect(result.errors).toEqual({})
        expect(result.values).toEqual(validValues)
    })

    it('should return error when licenceNumber is missing', () => {
        const result = drivingLicenceValidator({
            values: {
                ...validValues,
                licenceNumber: '',
            },
        })

        expect(result.errors.licenceNumber).toEqual([{ message: 'Licence number is required.' }])
    })

    it('should return error when issuingCountry is missing', () => {
        const result = drivingLicenceValidator({
            values: {
                ...validValues,
                issuingCountry: '',
            },
        })

        expect(result.errors.issuingCountry).toEqual([{ message: 'Issuing Country is required.' }])
    })

    it('should return error when issueDate is missing', () => {
        const result = drivingLicenceValidator({
            values: {
                ...validValues,
                issueDate: '',
            },
        })

        expect(result.errors.issueDate).toEqual([{ message: 'Issue date is required.' }])
    })

    it('should return error when expiryDate is missing', () => {
        const result = drivingLicenceValidator({
            values: {
                ...validValues,
                expiryDate: '',
            },
        })

        expect(result.errors.expiryDate).toEqual([{ message: 'Expiry date is required.' }])
    })
})
