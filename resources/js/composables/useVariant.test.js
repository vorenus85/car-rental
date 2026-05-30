import { describe, it, expect, vi, beforeEach } from 'vitest'
import { useVariant } from '@/composables/useVariant'
import { fetchVariants, fetchVariant, deleteVariantById } from '@/services/variantService'

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

vi.mock('@/services/variantService', () => ({
    fetchVariants: vi.fn(),
    fetchVariant: vi.fn(),
    deleteVariantById: vi.fn(),
}))

describe('useVariant', () => {
    beforeEach(() => {
        vi.clearAllMocks()
    })

    it('initializes default values', () => {
        const variant = useVariant()

        expect(variant.variantId).toBe(123)
        expect(variant.loading.value).toBe(false)
        expect(variant.formKey.value).toBe(0)

        expect(variant.initialValues.transmission).toBe('manual')
        expect(variant.initialValues.fuel).toBe('petrol')
        expect(variant.initialValues.seats).toBe('1')
        expect(variant.initialValues.doors).toBe('1')
        expect(variant.initialValues.features).toEqual([])
    })

    it('loads variants', async () => {
        vi.mocked(fetchVariants).mockResolvedValue({
            data: [
                { id: 1, name: 'Economy' },
                { id: 2, name: 'Premium' },
            ],
        })

        const variant = useVariant()

        await variant.getVariants()

        expect(variant.variants.value).toHaveLength(2)
        expect(variant.loading.value).toBe(false)
    })

    it('loads variant details', async () => {
        vi.mocked(fetchVariant).mockResolvedValue({
            data: {
                name: 'Corolla Comfort',
                category: 'economy',
                body_type: 'sedan',
                transmission: 'automatic',
                fuel: 'hybrid',
                seats: 5,
                doors: 4,
                description: 'Test description',
                model_id: 10,
                features: [{ id: 1 }, { id: 2 }],
                model: {
                    brand: {
                        id: 3,
                    },
                    brand_id: 3,
                },
            },
        })

        const variant = useVariant()

        await variant.getVariant()

        expect(variant.initialValues.name).toBe('Corolla Comfort')
        expect(variant.initialValues.category).toBe('economy')
        expect(variant.initialValues.body_type).toBe('sedan')
        expect(variant.initialValues.transmission).toBe('automatic')
        expect(variant.initialValues.fuel).toBe('hybrid')
        expect(variant.initialValues.features).toEqual([1, 2])

        expect(variant.selectedFeatures.value).toEqual([1, 2])
        expect(variant.selectedBrand.value).toBe(3)

        expect(variant.formKey.value).toBe(1)
    })

    it('deletes variant', async () => {
        vi.mocked(deleteVariantById).mockResolvedValue({})

        const variant = useVariant()

        variant.variants.value = [
            { id: 1, name: 'Economy' },
            { id: 2, name: 'Premium' },
        ]

        await variant.deleteVariant(1)

        expect(deleteVariantById).toHaveBeenCalledWith(1)

        expect(variant.variants.value).toEqual([{ id: 2, name: 'Premium' }])

        expect(successMock).toHaveBeenCalledWith('Variant deleted successfully!')
    })

    it('shows api error message when delete fails', async () => {
        vi.mocked(deleteVariantById).mockRejectedValue({
            response: {
                data: {
                    message: 'Variant is currently in use.',
                },
            },
        })

        const variant = useVariant()

        await variant.deleteVariant(1)

        expect(errorMock).toHaveBeenCalledWith('Variant is currently in use.')
    })

    it('shows default error message when delete fails', async () => {
        vi.mocked(deleteVariantById).mockRejectedValue(new Error())

        const variant = useVariant()

        await variant.deleteVariant(1)

        expect(errorMock).toHaveBeenCalledWith('Something went wrong while deleting the variant.')
    })

    it('handles fetchVariant errors', async () => {
        vi.mocked(fetchVariant).mockRejectedValue(new Error())

        const variant = useVariant()

        await expect(variant.getVariant()).resolves.toBeUndefined()

        expect(variant.loading.value).toBe(false)
    })

    it('handles fetchVariants errors', async () => {
        vi.mocked(fetchVariants).mockRejectedValue(new Error())

        const variant = useVariant()

        await expect(variant.getVariants()).resolves.toBeUndefined()

        expect(variant.loading.value).toBe(false)
    })
})
