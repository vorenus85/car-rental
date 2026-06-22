import { describe, it, expect } from 'vitest'
import { carModelValidator } from '@admin/validators/carModelValidator'

describe('carModelValidator', () => {
    const validValues = {
        brandId: 1,
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

    it('should return error when brandId is missing', () => {
        const result = carModelValidator({
            values: {
                ...validValues,
                brandId: '',
            },
        })

        expect(result.errors.brandId).toEqual([{ message: 'Brand is required.' }])
    })
})
