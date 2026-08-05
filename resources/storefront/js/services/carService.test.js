import { describe, it, expect, vi, beforeEach } from 'vitest'
import axios from 'axios'

import {
    fetchRandomCars,
    fetchSimilarCars,
    fetchCars,
    fetchCar,
} from '@storefront/services/carService'

vi.mock('axios')

describe('carService', () => {
    beforeEach(() => {
        vi.clearAllMocks()
    })

    describe('fetchRandomCars', () => {
        it('should call GET /api/storefront/cars/randoms', async () => {
            axios.get.mockResolvedValue({
                data: [],
            })

            const response = await fetchRandomCars()

            expect(axios.get).toHaveBeenCalledWith('/api/storefront/cars/randoms')
            expect(response.data).toEqual([])
        })
    })

    describe('fetchSimilarCars', () => {
        it('should call GET /api/storefront/cars/similars/:id', async () => {
            axios.get.mockResolvedValue({
                data: [],
            })

            const response = await fetchSimilarCars(12)

            expect(axios.get).toHaveBeenCalledWith('/api/storefront/cars/similars/12')
            expect(response.data).toEqual([])
        })
    })

    describe('fetchCars', () => {
        it('should call GET /api/storefront/cars/ with params', async () => {
            const params = {
                page: 2,
                search: 'bmw',
            }

            axios.get.mockResolvedValue({
                data: [],
            })

            const response = await fetchCars(params)

            expect(axios.get).toHaveBeenCalledWith('/api/storefront/cars/', {
                params,
            })
            expect(response.data).toEqual([])
        })
    })

    describe('fetchCar', () => {
        it('should call GET /api/storefront/cars/:id', async () => {
            axios.get.mockResolvedValue({
                data: {},
            })

            const response = await fetchCar(8)

            expect(axios.get).toHaveBeenCalledWith('/api/storefront/cars/8')
            expect(response.data).toEqual({})
        })
    })
})
