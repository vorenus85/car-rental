import { describe, it, expect, vi, beforeEach } from 'vitest'

import { fetchLocations } from '@storefront/services/locationService'
import { useLocation } from '@storefront/composables/useLocation'

vi.mock('@storefront/services/locationService', () => ({
    fetchLocations: vi.fn(),
}))

describe('useLocation', () => {
    beforeEach(() => {
        vi.clearAllMocks()
    })

    it('should fetch locations and expose grouped locations', async () => {
        const locationsData = [
            { id: 1, name: 'Budapest Airport', country: 'hu' },
            { id: 2, name: 'Vienna Airport', country: 'at' },
            { id: 3, name: 'Debrecen Downtown', country: 'hu' },
        ]

        vi.mocked(fetchLocations).mockResolvedValue({
            data: locationsData,
        })

        const { getLocations, locations, groupedLocations } = useLocation()

        await getLocations()

        expect(fetchLocations).toHaveBeenCalledTimes(1)
        expect(locations.value).toEqual(locationsData)
        expect(groupedLocations.value).toEqual([
            {
                label: 'Hungary',
                code: 'hu',
                items: [
                    { label: 'Budapest Airport', value: 1 },
                    { label: 'Debrecen Downtown', value: 3 },
                ],
            },
            {
                label: 'Austria',
                code: 'at',
                items: [{ label: 'Vienna Airport', value: 2 }],
            },
        ])
    })

    it('should keep loading false when getLocations fails', async () => {
        vi.mocked(fetchLocations).mockRejectedValue(new Error('API error'))

        const { getLocations, locations } = useLocation()

        await getLocations()

        expect(fetchLocations).toHaveBeenCalledTimes(1)
        expect(locations.value).toEqual([])
    })
})
