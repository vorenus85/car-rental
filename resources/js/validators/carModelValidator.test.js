import { describe, it, expect } from 'vitest'
import { carModelValidator } from '@/validators/carModelValidator'

describe('carModelValidator', () => {
    it('should return error when name is missing', () => {
        const result = carModelValidator({
            values: {
                brand_id: 1,
            },
        })

        expect(result.errors).toEqual({
            name: [{ message: 'Car model name is required.' }],
        })
    })

    it('should return error when brand_id is missing', () => {
        const result = carModelValidator({
            values: {
                name: 'Crimson',
            },
        })

        expect(result.errors).toEqual({
            brand_id: [{ message: 'Brand is required.' }],
        })
    })
})
