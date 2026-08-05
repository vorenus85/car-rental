import { describe, it, expect, vi, beforeEach } from 'vitest'

import { ref } from 'vue'

import { fetchCar } from '@storefront/services/carService.js'
import { useCarFilters } from '@storefront/composables/useCarFilters'
import { useCar } from '@storefront/composables/useCar'

vi.mock('@storefront/services/carService.js', () => ({
    fetchCar: vi.fn(),
}))

vi.mock('@storefront/composables/useCarFilters', () => ({
    useCarFilters: vi.fn(),
}))

describe('useCar', () => {
    beforeEach(() => {
        vi.clearAllMocks()

        vi.mocked(useCarFilters).mockReturnValue({
            filterParams: ref({
                carTypes: [
                    { label: 'SUV', value: 'suv' },
                    { label: 'Sedan', value: 'sedan' },
                ],
            }),
        })
    })

    it('should fetch car data and expose the mapped car', async () => {
        const carData = {
            bodyType: 'suv',
            brand: 'BMW',
            model: 'X5',
        }

        vi.mocked(fetchCar).mockResolvedValue({
            data: {
                data: carData,
            },
        })

        const car = useCar()

        expect(car.loadingCar.value).toBe(false)

        await car.getCar(12)

        expect(fetchCar).toHaveBeenCalledWith(12)
        expect(car.loadingCar.value).toBe(false)
        expect(car.car.value).toEqual(carData)
    })

    it('should resolve bodyType from filter params', async () => {
        vi.mocked(fetchCar).mockResolvedValue({
            data: {
                data: {
                    bodyType: 'sedan',
                },
            },
        })

        const car = useCar()

        car.car.value = {
            bodyType: 'sedan',
        }

        expect(car.bodyType.value).toEqual({
            label: 'Sedan',
            value: 'sedan',
        })

        await car.getCar(1)

        expect(car.bodyType.value).toEqual({
            label: 'Sedan',
            value: 'sedan',
        })
    })
})
