import { describe, it, expect, vi, beforeEach } from 'vitest'

import { fetchRandomCars, fetchSimilarCars } from '@storefront/services/carService'
import { useCars } from '@storefront/composables/useCars'

vi.mock('@storefront/services/carService', () => ({
    fetchRandomCars: vi.fn(),
    fetchSimilarCars: vi.fn(),
}))

describe('useCars', () => {
    beforeEach(() => {
        vi.clearAllMocks()
    })

    it('should fetch random cars and expose them', async () => {
        const randomCars = [
            { id: 1, name: 'BMW X5' },
            { id: 2, name: 'Toyota RAV4' },
        ]

        vi.mocked(fetchRandomCars).mockResolvedValue({
            data: {
                data: randomCars,
            },
        })

        const { getRandomCars, cars, loadingCars } = useCars()

        expect(loadingCars.value).toBe(false)

        await getRandomCars()

        expect(fetchRandomCars).toHaveBeenCalledTimes(1)
        expect(cars.value).toEqual(randomCars)
        expect(loadingCars.value).toBe(false)
    })

    it('should fetch similar cars and expose them', async () => {
        const similarCars = [
            { id: 3, name: 'Audi Q5' },
            { id: 4, name: 'Mercedes GLC' },
        ]

        vi.mocked(fetchSimilarCars).mockResolvedValue({
            data: {
                data: similarCars,
            },
        })

        const { getSimilarCars, cars, loadingCars } = useCars()

        await getSimilarCars(12)

        expect(fetchSimilarCars).toHaveBeenCalledWith(12)
        expect(cars.value).toEqual(similarCars)
        expect(loadingCars.value).toBe(false)
    })
})
