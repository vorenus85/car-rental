import { describe, it, expect, vi, beforeEach } from 'vitest'
import { useCarModel } from '@/composables/useCarModel'
import {
    fetchCarModels,
    fetchCarModelsByBrand,
    fetchCarModel,
    deleteCarModelById,
} from '@/services/carModelService'

const successMock = vi.fn()
const errorMock = vi.fn()

vi.mock('vue-router', () => ({
    useRoute: () => ({
        params: {
            id: 123,
        },
    }),
}))

vi.mock('@/composables/useCustomToast', () => ({
    useCustomToast: () => ({
        customToast: {
            success: successMock,
            error: errorMock,
        },
    }),
}))

vi.mock('@/services/carModelService', () => ({
    fetchCarModels: vi.fn(),
    fetchCarModelsByBrand: vi.fn(),
    fetchCarModel: vi.fn(),
    deleteCarModelById: vi.fn(),
}))

describe('useCarModel', () => {
    beforeEach(() => {
        vi.clearAllMocks()
    })

    it('initializes default values', () => {
        const model = useCarModel()

        expect(model.loading.value).toBe(false)
        expect(model.formKey.value).toBe(0)
        expect(model.modelId).toBe(123)

        expect(model.initialValues).toEqual({
            name: '',
            brand_id: '',
            description: '',
        })
    })

    it('loads car models', async () => {
        vi.mocked(fetchCarModels).mockResolvedValue({
            data: {
                data: [
                    { id: 1, name: 'Corolla' },
                    { id: 2, name: 'Yaris' },
                ],
            },
        })

        const model = useCarModel()

        await model.getCarModels()

        expect(model.carModels.value).toEqual([
            { id: 1, name: 'Corolla' },
            { id: 2, name: 'Yaris' },
        ])
    })

    it('loads car models by brand', async () => {
        vi.mocked(fetchCarModelsByBrand).mockResolvedValue({
            data: [
                { id: 1, name: 'Corolla' },
                { id: 2, name: 'Yaris' },
            ],
        })

        const model = useCarModel()

        await model.getCarModelsByBrand({
            brand_id: 5,
        })

        expect(fetchCarModelsByBrand).toHaveBeenCalledWith({
            brand_id: 5,
        })

        expect(model.carModels.value).toHaveLength(2)
    })

    it('loads a single car model', async () => {
        vi.mocked(fetchCarModel).mockResolvedValue({
            data: {
                name: 'Corolla',
                description: 'Popular compact sedan',
                brand_id: 1,
            },
        })

        const model = useCarModel()

        await model.getCarModel()

        expect(model.initialValues).toEqual({
            name: 'Corolla',
            description: 'Popular compact sedan',
            brand_id: 1,
        })

        expect(model.formKey.value).toBe(1)
    })

    it('deletes a car model', async () => {
        vi.mocked(deleteCarModelById).mockResolvedValue({})

        const model = useCarModel()

        model.carModels.value = [
            { id: 1, name: 'Corolla' },
            { id: 2, name: 'Yaris' },
        ]

        await model.deleteCarModel(1)

        expect(deleteCarModelById).toHaveBeenCalledWith(1)

        expect(model.carModels.value).toEqual([{ id: 2, name: 'Yaris' }])

        expect(successMock).toHaveBeenCalledWith('Model deleted successfully!')
    })

    it('shows api error when delete fails', async () => {
        vi.mocked(deleteCarModelById).mockRejectedValue({
            response: {
                data: {
                    message: 'Model is used by variants.',
                },
            },
        })

        const model = useCarModel()

        await model.deleteCarModel(1)

        expect(errorMock).toHaveBeenCalledWith('Model is used by variants.')
    })

    it('shows default error when delete fails', async () => {
        vi.mocked(deleteCarModelById).mockRejectedValue(new Error())

        const model = useCarModel()

        await model.deleteCarModel(1)

        expect(errorMock).toHaveBeenCalledWith('Something went wrong while deleting the car model.')
    })

    it('handles getCarModels errors', async () => {
        vi.mocked(fetchCarModels).mockRejectedValue(new Error())

        const model = useCarModel()

        await expect(model.getCarModels()).resolves.toBeUndefined()

        expect(model.loading.value).toBe(false)
    })

    it('handles getCarModel errors', async () => {
        vi.mocked(fetchCarModel).mockRejectedValue(new Error())

        const model = useCarModel()

        await expect(model.getCarModel()).resolves.toBeUndefined()

        expect(model.loading.value).toBe(false)
    })

    it('handles getCarModelsByBrand errors', async () => {
        vi.mocked(fetchCarModelsByBrand).mockRejectedValue(new Error())

        const model = useCarModel()

        await expect(model.getCarModelsByBrand({ brand_id: 1 })).resolves.toBeUndefined()

        expect(model.loading.value).toBe(false)
    })
})
