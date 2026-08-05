import { describe, it, expect } from 'vitest'
import { extraValidator } from '@admin/validators/extraValidator'

describe('extraValidator', () => {
    const validValues = {
        name: 'Custom extra',
        price: 123,
        maxQuantity: 2,
    }

    it('returns no errors for valid values', () => {
        const result = extraValidator({ values: validValues })

        expect(result.errors).toEqual({})
    })

    it('should return error when name is missing', () => {
        const result = extraValidator({
            values: {
                ...validValues,
                name: '',
            },
        })

        expect(result.errors.name).toEqual([{ message: 'Extra name is required.' }])
    })

    it('should return error when price is missing', () => {
        const result = extraValidator({
            values: {
                ...validValues,
                price: '',
            },
        })

        expect(result.errors.price).toEqual([{ message: 'Extra price is required.' }])
    })

    it('should return error when maxQuantity is missing', () => {
        const result = extraValidator({
            values: {
                ...validValues,
                maxQuantity: '',
            },
        })

        expect(result.errors.maxQuantity).toEqual([{ message: 'Max quantity is required.' }])
    })
})
