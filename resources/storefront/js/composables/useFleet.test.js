import { describe, it, expect, vi, beforeEach } from 'vitest'

import { fetchCars } from '@storefront/services/carService'
import { useFleet } from '@storefront/composables/useFleet'

vi.mock('@storefront/services/carService', () => ({
    fetchCars: vi.fn(),
}))

describe('useFleet', () => {
    beforeEach(() => {
        vi.clearAllMocks()
    })

    it('should fetch cars and expose pagination metadata', async () => {
        const carsData = [
            { id: 1, name: 'BMW X5' },
            { id: 2, name: 'Toyota RAV4' },
        ]

        const meta = {
            total: 48,
            current_page: 3,
            per_page: 12,
        }

        vi.mocked(fetchCars).mockResolvedValue({
            data: {
                data: carsData,
                meta,
            },
        })

        const { getCars, cars, loadingCars, total, currentPage, perPage } = useFleet()

        expect(loadingCars.value).toBe(false)

        await getCars({
            page: 3,
            search: 'bmw',
        })

        expect(fetchCars).toHaveBeenCalledWith({
            page: 3,
            search: 'bmw',
        })
        expect(cars.value).toEqual(carsData)
        expect(total.value).toBe(48)
        expect(currentPage.value).toBe(3)
        expect(perPage.value).toBe(12)
        expect(loadingCars.value).toBe(false)
    })

    it('should keep loading false when getCars fails', async () => {
        vi.mocked(fetchCars).mockRejectedValue(new Error('API error'))

        const { getCars, cars, loadingCars, total, currentPage, perPage } = useFleet()

        await getCars({
            page: 1,
        })

        expect(fetchCars).toHaveBeenCalledWith({
            page: 1,
        })
        expect(cars.value).toEqual([])
        expect(total.value).toBe(0)
        expect(currentPage.value).toBe(1)
        expect(perPage.value).toBe(12)
        expect(loadingCars.value).toBe(false)
    })
})
