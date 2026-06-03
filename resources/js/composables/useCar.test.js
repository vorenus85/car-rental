import { describe, it, expect, vi, beforeEach } from 'vitest'
import { useCar } from '@/composables/useCar'
import {
    fetchCars,
    fetchCar,
    deleteCarById,
    uploadCarImage,
    deleteCarImage,
} from '@/services/carService'

vi.mock('@/services/carService')

vi.mock('vue-router', () => ({
    useRoute: () => ({
        params: {
            id: 1,
        },
    }),
}))

vi.mock('@/composables/useCustomToast', () => ({
    useCustomToast: () => ({
        customToast: {
            success: vi.fn(),
            error: vi.fn(),
        },
    }),
}))

describe('useCar', () => {
    beforeEach(() => {
        vi.clearAllMocks()
    })

    it('loads cars', async () => {
        vi.mocked(fetchCars).mockResolvedValue({
            data: [
                { id: 1, licence_plate: 'ABC-123' },
                { id: 2, licence_plate: 'DEF-456' },
            ],
        })

        const car = useCar()

        await car.getCars()

        expect(fetchCars).toHaveBeenCalled()
        expect(car.cars.value).toHaveLength(2)
        expect(car.loading.value).toBe(false)
    })

    it('loads car details', async () => {
        vi.mocked(fetchCar).mockResolvedValue({
            data: {
                licence_plate: 'ABC-123',
                color: 'Red',
                production_year: 2020,
                mileage: 10000,
                price_per_day: 50,
                status: 'available',
                description: 'Test description',
                image: 'test.jpg',
                image_url: '/test.jpg',
                variant: {
                    id: 3,
                    category: 'premium',
                    body_type: 'sedan',
                    transmission: 'automatic',
                    fuel_type: 'electric',
                    seats: 5,
                    doors: 4,
                    model: {
                        id: 2,
                        brand: {
                            id: 1,
                        },
                    },
                },
            },
        })

        const car = useCar()

        await car.getCar()

        expect(car.initialValues.brand_id).toBe(1)
        expect(car.initialValues.model_id).toBe(2)
        expect(car.initialValues.variant_id).toBe(3)
        expect(car.initialValues.licence_plate).toBe('ABC-123')
        expect(car.initialValues.color).toBe('Red')
        expect(car.formKey.value).toBe(1)
        expect(car.loading.value).toBe(false)
    })

    it('deletes car from list', async () => {
        vi.mocked(deleteCarById).mockResolvedValue({})

        const car = useCar()

        car.cars.value = [{ id: 1 }, { id: 2 }, { id: 3 }]

        await car.deleteCar(2)

        expect(deleteCarById).toHaveBeenCalledWith(2)

        expect(car.cars.value).toEqual([{ id: 1 }, { id: 3 }])

        expect(car.loading.value).toBe(false)
    })

    it('resets upload state on remove image', () => {
        const car = useCar()

        car.isUploading.value = true
        car.uploadProgress.value = 80

        car.onRemoveImage()

        expect(car.isUploading.value).toBe(false)
        expect(car.uploadProgress.value).toBe(0)
    })

    it('clears uploader status', () => {
        const car = useCar()

        car.isUploading.value = true
        car.uploadProgress.value = 50

        car.onClearUploaderStatus()

        expect(car.isUploading.value).toBe(false)
        expect(car.uploadProgress.value).toBe(0)
    })

    it('uploads image', async () => {
        vi.mocked(uploadCarImage).mockResolvedValue({
            data: {
                filename: 'uploaded.jpg',
            },
        })

        const car = useCar()

        const file = new File(['test'], 'test.jpg', {
            type: 'image/jpeg',
        })

        await car.onImageUpload({
            files: [file],
        })

        expect(uploadCarImage).toHaveBeenCalled()
        expect(car.uploadedImage.value).toBe('uploaded.jpg')
    })

    it('deletes image', async () => {
        vi.mocked(deleteCarImage).mockResolvedValue({})

        const car = useCar()

        car.initialValues.image = 'old.jpg'
        car.uploadedImage.value = 'old.jpg'

        await car.deleteImage()

        expect(deleteCarImage).toHaveBeenCalledWith(1)
        expect(car.initialValues.image).toBe('')
        expect(car.uploadedImage.value).toBe('')
    })

    it('handles getCars error', async () => {
        vi.mocked(fetchCars).mockRejectedValue(new Error('API Error'))

        const car = useCar()

        await car.getCars()

        expect(car.loading.value).toBe(false)
        expect(car.cars.value).toEqual([])
    })

    it('handles getCar error', async () => {
        vi.mocked(fetchCar).mockRejectedValue(new Error('API Error'))

        const car = useCar()

        await car.getCar()

        expect(car.loading.value).toBe(false)
    })
})
