import { describe, it, expect, vi, beforeEach } from 'vitest'
import axios from 'axios'

import { fetchLocations } from '@storefront/services/locationService'

vi.mock('axios')

describe('locationService', () => {
    beforeEach(() => {
        vi.clearAllMocks()
    })

    it('should call GET /api/storefront/locations', async () => {
        axios.get.mockResolvedValue({
            data: [],
        })

        const response = await fetchLocations()

        expect(axios.get).toHaveBeenCalledWith('/api/storefront/locations')
        expect(response.data).toEqual([])
    })
})
