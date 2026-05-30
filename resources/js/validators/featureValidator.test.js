import { describe, it, expect } from 'vitest'
import { featureValidator } from '@/validators/featureValidator'

describe('featureValidator', () => {
    it('should return error when name is missing', () => {
        const result = featureValidator({
            values: {
                category: 'luxury',
            },
        })

        expect(result.errors).toEqual({
            name: [{ message: 'Feature name is required.' }],
        })
    })

    it('should return error when category is missing', () => {
        const result = featureValidator({
            values: {
                name: 'Sunroof',
            },
        })

        expect(result.errors).toEqual({
            category: [{ message: 'Feature category is required.' }],
        })
    })
})
