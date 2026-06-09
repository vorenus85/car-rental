import { describe, it, expect } from 'vitest'
import { featureValidator } from '@admin/validators/featureValidator'

describe('featureValidator', () => {
    const validValues = {
        name: 'Sunroof',
        category: 'luxury',
    }

    it('should return error when name is missing', () => {
        const result = featureValidator({
            values: {
                ...validValues,
                name: '',
            },
        })

        expect(result.errors.name).toEqual([{ message: 'Feature name is required.' }])
    })

    it('should return error when category is missing', () => {
        const result = featureValidator({
            values: {
                ...validValues,
                category: '',
            },
        })

        expect(result.errors.category).toEqual([{ message: 'Feature category is required.' }])
    })
})
