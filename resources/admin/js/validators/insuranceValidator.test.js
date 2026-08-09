import { describe, it, expect } from 'vitest'
import { insuranceValidator } from '@admin/validators/insuranceValidator'

describe('insuranceValidator', () => {
    const validValues = {
        name: 'Premium insurance',
        price: 123,
    }

    it('returns no errors for valid values', () => {
        const result = insuranceValidator({ values: validValues })

        expect(result.errors).toEqual({})
    })

    it('requires insurance name', () => {
        const result = insuranceValidator({
            values: {
                ...validValues,
                name: '',
            },
        })

        expect(result.errors.name).toEqual([{ message: 'Insurance name is required.' }])
    })

    it('requires insurance price', () => {
        const result = insuranceValidator({
            values: {
                ...validValues,
                price: '',
            },
        })

        expect(result.errors.price).toEqual([{ message: 'Price per day must be greater than 0.' }])
    })
})
