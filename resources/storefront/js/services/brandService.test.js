import { describe, it, expect, vi, beforeEach } from 'vitest'
import axios from 'axios'

import { fetchBrands } from '@storefront/services/brandService'

vi.mock('axios')

describe('brandService', () => {
    beforeEach(() => {
        vi.clearAllMocks()
    })

    it('should call GET /api/storefront/brands', async () => {
        axios.get.mockResolvedValue({
            data: [],
        })

        const response = await fetchBrands()

        expect(axios.get).toHaveBeenCalledWith('/api/storefront/brands')
        expect(response.data).toEqual([])
    })
})
