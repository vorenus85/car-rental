import { describe, it, expect, vi, beforeEach } from 'vitest'

import { fetchBrands } from '@storefront/services/brandService'
import { useBrand } from '@storefront/composables/useBrand'

vi.mock('@storefront/services/brandService', () => ({
    fetchBrands: vi.fn(),
}))

describe('useBrand', () => {
    beforeEach(() => {
        vi.clearAllMocks()
    })

    it('should fetch brands and return response data', async () => {
        const brands = [
            { id: 1, name: 'BMW' },
            { id: 2, name: 'Toyota' },
        ]

        fetchBrands.mockResolvedValue({
            data: {
                data: brands,
            },
        })

        const { getBrands } = useBrand()
        const result = await getBrands()

        expect(fetchBrands).toHaveBeenCalledTimes(1)
        expect(result).toEqual(brands)
    })
})
