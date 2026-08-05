import { describe, it, expect, vi, beforeEach } from 'vitest'

import { fetchInsurances } from '@storefront/services/insuranceService'
import { useInsurance } from '@storefront/composables/useInsurance'

vi.mock('@storefront/services/insuranceService', () => ({
    fetchInsurances: vi.fn(),
}))

describe('useInsurance', () => {
    beforeEach(() => {
        vi.clearAllMocks()
    })

    it('should fetch insurances and return response data', async () => {
        const insurances = [
            { id: 1, name: 'Basic coverage' },
            { id: 2, name: 'Full coverage' },
        ]

        fetchInsurances.mockResolvedValue({
            data: {
                data: insurances,
            },
        })

        const { getInsurances } = useInsurance()
        const result = await getInsurances()

        expect(fetchInsurances).toHaveBeenCalledTimes(1)
        expect(result).toEqual(insurances)
    })
})
