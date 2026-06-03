import axios from 'axios'
import {
    fetchCars,
    fetchCar,
    deleteCarById,
    createCar,
    updateCarById,
    uploadCarImage,
    deleteCarImage,
} from '@/services/carService'
import { afterEach, describe, expect, it, vi } from 'vitest'

vi.mock('axios')

describe('carService', () => {
    afterEach(() => {
        vi.clearAllMocks()
    })

    it('fetchCars calls correct endpoint', async () => {
        axios.get.mockResolvedValue({ data: [] })

        await fetchCars()

        expect(axios.get).toHaveBeenCalledWith('/api/admin/cars')
    })

    it('fetchCar calls correct endpoint', async () => {
        axios.get.mockResolvedValue({ data: {} })

        await fetchCar(123)

        expect(axios.get).toHaveBeenCalledWith('/api/admin/cars/123')
    })

    it('deleteCarById calls correct endpoint', async () => {
        axios.delete.mockResolvedValue({})

        await deleteCarById(123)

        expect(axios.delete).toHaveBeenCalledWith('/api/admin/cars/123')
    })

    it('createCar calls correct endpoint with payload', async () => {
        axios.post.mockResolvedValue({})

        const values = {
            licence_plate: 'ABC-123',
            color: 'red',
        }

        await createCar(values)

        expect(axios.post).toHaveBeenCalledWith('/api/admin/cars', values)
    })

    it('updateCarById calls correct endpoint with payload', async () => {
        axios.put.mockResolvedValue({})

        const values = {
            licence_plate: 'XYZ-987',
        }

        await updateCarById(123, values)

        expect(axios.put).toHaveBeenCalledWith('/api/admin/cars/123', values)
    })

    it('deleteCarImage calls correct endpoint', async () => {
        axios.delete.mockResolvedValue({})

        await deleteCarImage(456)

        expect(axios.delete).toHaveBeenCalledWith('/api/admin/cars/image/delete/456')
    })

    it('uploadCarImage uploads file', async () => {
        axios.post.mockResolvedValue({})

        const file = new File(['test'], 'car.jpg', {
            type: 'image/jpeg',
        })

        await uploadCarImage(file)

        expect(axios.post).toHaveBeenCalledTimes(1)

        expect(axios.post.mock.calls[0][0]).toBe('/api/admin/cars/image/upload')

        expect(axios.post.mock.calls[0][1]).toBeInstanceOf(FormData)
    })

    it('uploadCarImage reports progress', async () => {
        axios.post.mockImplementation((url, formData, config) => {
            config.onUploadProgress({
                loaded: 50,
                total: 100,
            })

            return Promise.resolve({})
        })

        const file = new File(['test'], 'car.jpg', {
            type: 'image/jpeg',
        })

        const onProgress = vi.fn()

        await uploadCarImage(file, onProgress)

        expect(onProgress).toHaveBeenCalledWith(50)
    })
})
