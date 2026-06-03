import { describe, it, expect } from 'vitest'
import { brandValidator } from '@/validators/brandValidator'

describe('brandValidator', () => {
    const validValues = {
        name: 'Toyota',
    }

    it('returns no errors for valid values', () => {
        const result = brandValidator({ values: validValues })

        expect(result.errors).toEqual({})
    })

    it('should return error when name is missing', () => {
        const result = brandValidator({
            values: {},
        })

        expect(result.errors).toEqual({
            name: [{ message: 'Brand name is required.' }],
        })
    })
})
