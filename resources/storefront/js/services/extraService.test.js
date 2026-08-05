import { describe, it, expect, vi, beforeEach } from 'vitest'
import axios from 'axios'

import { fetchExtras } from '@storefront/services/extraService'

vi.mock('axios')

describe('extraService', () => {
    beforeEach(() => {
        vi.clearAllMocks()
    })

    it('should call GET /api/storefront/extras', async () => {
        axios.get.mockResolvedValue({
            data: [],
        })

        const response = await fetchExtras()

        expect(axios.get).toHaveBeenCalledWith('/api/storefront/extras')
        expect(response.data).toEqual([])
    })
})
