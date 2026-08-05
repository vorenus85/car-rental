import { describe, it, expect, vi, beforeEach } from 'vitest'

import { fetchExtras } from '@storefront/services/extraService'
import { useExtra } from '@storefront/composables/useExtra'

vi.mock('@storefront/services/extraService', () => ({
    fetchExtras: vi.fn(),
}))

describe('useExtra', () => {
    beforeEach(() => {
        vi.clearAllMocks()
    })

    it('should fetch extras and return response data', async () => {
        const extras = [
            { id: 1, name: 'GPS' },
            { id: 2, name: 'Child seat' },
        ]

        fetchExtras.mockResolvedValue({
            data: {
                data: extras,
            },
        })

        const { getExtras } = useExtra()
        const result = await getExtras()

        expect(fetchExtras).toHaveBeenCalledTimes(1)
        expect(result).toEqual(extras)
    })
})
