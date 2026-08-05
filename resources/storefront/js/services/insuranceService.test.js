import { describe, it, expect, vi, beforeEach } from 'vitest'
import axios from 'axios'

import { fetchInsurances } from '@storefront/services/insuranceService'

vi.mock('axios')

describe('insuranceService', () => {
    beforeEach(() => {
        vi.clearAllMocks()
    })

    it('should call GET /api/storefront/insurances', async () => {
        axios.get.mockResolvedValue({
            data: [],
        })

        const response = await fetchInsurances()

        expect(axios.get).toHaveBeenCalledWith('/api/storefront/insurances')
        expect(response.data).toEqual([])
    })
})
