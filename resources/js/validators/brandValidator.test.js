import { describe, it, expect } from 'vitest'
import { brandValidator } from '@/validators/brandValidator'

describe('brandValidator', () => {
    it('should return error when name is missing', () => {
        const result = brandValidator({
            values: {},
        })

        expect(result.errors).toEqual({
            name: [{ message: 'Brand name is required.' }],
        })
    })
})
