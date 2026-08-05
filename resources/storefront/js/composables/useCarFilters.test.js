import { describe, it, expect, vi, beforeEach } from 'vitest'

import { useBrandStore } from '@storefront/stores/brandStore'
import { useCarFilters } from '@storefront/composables/useCarFilters'

vi.mock('@storefront/stores/brandStore', () => ({
    useBrandStore: vi.fn(),
}))

describe('useCarFilters', () => {
    beforeEach(() => {
        vi.clearAllMocks()

        vi.mocked(useBrandStore).mockReturnValue({
            brands: [
                { id: 1, name: 'BMW' },
                { id: 2, name: 'Toyota' },
            ],
        })
    })

    it('should expose the default filter options and brand store brands', () => {
        const { filterParams } = useCarFilters()

        expect(filterParams.value.carTypes).toEqual([
            { label: 'SUV', value: 'suv' },
            { label: 'Sedan', value: 'sedan' },
            { label: 'Hatchback', value: 'hatchback' },
            { label: 'Coupe', value: 'coupe' },
            { label: 'Wagon', value: 'wagon' },
        ])

        expect(filterParams.value.transmissions).toEqual([
            { label: 'Automatic', value: 'automatic' },
            { label: 'Manual', value: 'manual' },
        ])

        expect(filterParams.value.fuelTypes).toEqual([
            { label: 'Petrol', value: 'petrol' },
            { label: 'Diesel', value: 'diesel' },
            { label: 'Hybrid', value: 'hybrid' },
            { label: 'Electric', value: 'electric' },
        ])

        expect(filterParams.value.seats).toEqual([
            { label: '2', value: 2 },
            { label: '4', value: 4 },
            { label: '5', value: 5 },
            { label: '6', value: 6 },
        ])

        expect(filterParams.value.luggageCounts).toEqual([
            { label: '1', value: 1 },
            { label: '2', value: 2 },
            { label: '3', value: 3 },
            { label: '4', value: 4 },
            { label: '5', value: 5 },
        ])

        expect(filterParams.value.brands).toEqual([
            { id: 1, name: 'BMW' },
            { id: 2, name: 'Toyota' },
        ])
    })
})
