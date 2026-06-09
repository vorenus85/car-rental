import axios from 'axios'
import {
    fetchCarModels,
    fetchCarModelsByBrand,
    fetchCarModel,
    deleteCarModelById,
    createCarModel,
    updateCarModelById,
} from '@admin/services/carModelService'

import { afterEach, describe, expect, it, vi } from 'vitest'

vi.mock('axios')

describe('carModelService', () => {
    afterEach(() => {
        vi.clearAllMocks()
    })

    it('fetchCarModels calls correct endpoint', async () => {
        axios.get.mockResolvedValue({
            data: [],
        })

        await fetchCarModels()

        expect(axios.get).toHaveBeenCalledWith('/api/admin/car-models')
    })

    it('fetchCarModelsByBrand calls correct endpoint with params', async () => {
        const params = {
            brand_id: 1,
        }

        axios.get.mockResolvedValue({
            data: [],
        })

        await fetchCarModelsByBrand(params)

        expect(axios.get).toHaveBeenCalledWith('/api/admin/car-models/options', { params })
    })

    it('fetchCarModel calls correct endpoint', async () => {
        axios.get.mockResolvedValue({
            data: {},
        })

        await fetchCarModel(1)

        expect(axios.get).toHaveBeenCalledWith('/api/admin/car-models/1')
    })

    it('deleteCarModelById calls correct endpoint', async () => {
        axios.delete.mockResolvedValue({
            data: {},
        })

        await deleteCarModelById(1)

        expect(axios.delete).toHaveBeenCalledWith('/api/admin/car-models/1')
    })

    it('createCarModel sends payload correctly', async () => {
        const values = {
            brand_id: 1,
            name: 'Corolla',
            description: 'Compact family car',
        }

        axios.post.mockResolvedValue({
            data: values,
        })

        await createCarModel(values)

        expect(axios.post).toHaveBeenCalledWith('/api/admin/car-models', values)
    })

    it('updateCarModelById sends payload correctly', async () => {
        const values = {
            brand_id: 1,
            name: 'Updated Corolla',
            description: 'Updated description',
        }

        axios.put.mockResolvedValue({
            data: values,
        })

        await updateCarModelById(1, values)

        expect(axios.put).toHaveBeenCalledWith('/api/admin/car-models/1', values)
    })
})
