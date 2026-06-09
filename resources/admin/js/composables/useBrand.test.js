import { describe, it, expect, vi, beforeEach } from 'vitest'
import { useBrand } from '@admin/composables/useBrand'
import {
    fetchBrands,
    fetchBrand,
    deleteBrandById,
    uploadBrandImage,
    deleteBrandImage,
} from '@admin/services/brandService'

const successMock = vi.fn()
const errorMock = vi.fn()

vi.mock('vue-router', () => ({
    useRoute: () => ({
        params: {
            id: 123,
        },
    }),
}))

vi.mock('@admin/composables/useCustomToast', () => ({
    useCustomToast: () => ({
        customToast: {
            success: successMock,
            error: errorMock,
        },
    }),
}))

vi.mock('@admin/services/brandService', () => ({
    fetchBrands: vi.fn(),
    fetchBrand: vi.fn(),
    deleteBrandById: vi.fn(),
    uploadBrandImage: vi.fn(),
    deleteBrandImage: vi.fn(),
}))

describe('useBrand', () => {
    beforeEach(() => {
        vi.clearAllMocks()
    })

    it('initializes default values', () => {
        const brand = useBrand()

        expect(brand.loading.value).toBe(false)
        expect(brand.formKey.value).toBe(0)
        expect(brand.brandId).toBe(123)

        expect(brand.initialValues).toEqual({
            name: '',
            image: '',
        })
    })

    it('loads brands', async () => {
        vi.mocked(fetchBrands).mockResolvedValue({
            data: [
                { id: 1, name: 'Toyota' },
                { id: 2, name: 'BMW' },
            ],
        })

        const brand = useBrand()

        await brand.getBrands()

        expect(brand.brands.value).toHaveLength(2)
    })

    it('loads brand details', async () => {
        vi.mocked(fetchBrand).mockResolvedValue({
            data: {
                name: 'Toyota',
                image: 'toyota.png',
                image_url: '/storage/toyota.png',
            },
        })

        const brand = useBrand()

        await brand.getBrand()

        expect(brand.initialValues.name).toBe('Toyota')
        expect(brand.initialValues.image).toBe('toyota.png')
        expect(brand.initialValues.image_url).toBe('/storage/toyota.png')
        expect(brand.formKey.value).toBe(1)
    })

    it('deletes brand', async () => {
        vi.mocked(deleteBrandById).mockResolvedValue({})

        const brand = useBrand()

        brand.brands.value = [
            { id: 1, name: 'Toyota' },
            { id: 2, name: 'BMW' },
        ]

        await brand.deleteBrand(1)

        expect(deleteBrandById).toHaveBeenCalledWith(1)

        expect(brand.brands.value).toEqual([{ id: 2, name: 'BMW' }])

        expect(successMock).toHaveBeenCalledWith('Brand deleted successfully!')
    })

    it('shows api error when delete fails', async () => {
        vi.mocked(deleteBrandById).mockRejectedValue({
            response: {
                data: {
                    message: 'Brand is in use.',
                },
            },
        })

        const brand = useBrand()

        await brand.deleteBrand(1)

        expect(errorMock).toHaveBeenCalledWith('Brand is in use.')
    })

    it('shows default delete error message', async () => {
        vi.mocked(deleteBrandById).mockRejectedValue(new Error())

        const brand = useBrand()

        await brand.deleteBrand(1)

        expect(errorMock).toHaveBeenCalledWith('Something went wrong while deleting the brand.')
    })

    it('clears uploader state on remove image', () => {
        const brand = useBrand()

        brand.isUploading.value = true
        brand.uploadProgress.value = 50

        brand.onRemoveImage()

        expect(brand.isUploading.value).toBe(false)
        expect(brand.uploadProgress.value).toBe(0)
    })

    it('clears uploader state', () => {
        const brand = useBrand()

        brand.isUploading.value = true
        brand.uploadProgress.value = 50

        brand.onClearUploaderStatus()

        expect(brand.isUploading.value).toBe(false)
        expect(brand.uploadProgress.value).toBe(0)
    })

    it('uploads image successfully', async () => {
        vi.mocked(uploadBrandImage).mockImplementation(async (file, progressCallback) => {
            progressCallback(100)

            return {
                data: {
                    filename: 'toyota.png',
                },
            }
        })

        const brand = useBrand()

        await brand.onImageUpload({
            files: [new File(['test'], 'toyota.png')],
        })

        expect(brand.uploadProgress.value).toBe(100)
        expect(brand.uploadedImage.value).toBe('toyota.png')
    })

    it('deletes image', async () => {
        vi.mocked(deleteBrandImage).mockResolvedValue({})

        const brand = useBrand()

        brand.initialValues.image = 'toyota.png'
        brand.uploadedImage.value = 'toyota.png'

        await brand.deleteImage()

        expect(deleteBrandImage).toHaveBeenCalledWith(123)
        expect(brand.initialValues.image).toBe('')
        expect(brand.uploadedImage.value).toBe('')
    })
})
