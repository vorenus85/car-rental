import { describe, it, expect } from 'vitest'
import { carModelValidator } from '@admin/validators/carModelValidator'

describe('carModelValidator', () => {
    const validValues = {
        brand_id: 1,
        name: 'Crimson',
    }

    it('should return error when name is missing', () => {
        const result = carModelValidator({
            values: {
                ...validValues,
                name: '',
            },
        })

        expect(result.errors.name).toEqual([{ message: 'Car model name is required.' }])
    })

    it('should return error when brand_id is missing', () => {
        const result = carModelValidator({
            values: {
                ...validValues,
                brand_id: '',
            },
        })

        expect(result.errors.brand_id).toEqual([{ message: 'Brand is required.' }])
    })
})
