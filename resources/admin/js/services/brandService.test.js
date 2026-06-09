import axios from 'axios'
import {
    fetchBrands,
    fetchBrand,
    deleteBrandById,
    createBrand,
    updateBrandById,
    uploadBrandImage,
    deleteBrandImage,
} from '@admin/services/brandService'
import { afterEach, describe, expect, it, vi } from 'vitest'

vi.mock('axios')

describe('brandService', () => {
    afterEach(() => {
        vi.clearAllMocks()
    })

    it('fetchBrands calls correct endpoint', async () => {
        axios.get.mockResolvedValue({
            data: [],
        })

        const params = {}

        await fetchBrands(params)

        expect(axios.get).toHaveBeenCalledWith('/api/admin/brands', { params })
    })

    it('fetchBrand calls correct endpoint', async () => {
        axios.get.mockResolvedValue({
            data: {},
        })

        await fetchBrand(1)

        expect(axios.get).toHaveBeenCalledWith('/api/admin/brands/1')
    })

    it('deleteBrandById calls correct endpoint', async () => {
        axios.delete.mockResolvedValue({
            data: {},
        })

        await deleteBrandById(1)

        expect(axios.delete).toHaveBeenCalledWith('/api/admin/brands/1')
    })

    it('createBrand sends payload correctly', async () => {
        const values = {
            name: 'Mercedes',
        }

        axios.post.mockResolvedValue({
            data: values,
        })

        await createBrand(values)

        expect(axios.post).toHaveBeenCalledWith('/api/admin/brands', values)
    })

    it('updateBrandById sends payload correctly', async () => {
        const values = {
            name: 'Mercedes',
        }

        axios.put.mockResolvedValue({
            data: values,
        })

        await updateBrandById(1, values)

        expect(axios.put).toHaveBeenCalledWith('/api/admin/brands/1', values)
    })

    it('uploadBrandImage calls correnct endpoint', async () => {
        axios.post.mockResolvedValue()

        const file = new File(['dummy content'], 'sample.jpg', {
            type: 'image/jpeg',
        })

        await uploadBrandImage('sample.jpg')

        expect(axios.post).toHaveBeenCalledWith(
            '/api/admin/brands/image/upload',
            expect.any(FormData),
            expect.objectContaining({
                onUploadProgress: expect.any(Function),
            })
        )
    })

    it('deleteBrandImage calls correct endpoint', async () => {
        axios.delete.mockResolvedValue()

        await deleteBrandImage(1)

        expect(axios.delete).toHaveBeenCalledWith('/api/admin/brands/image/delete/1')
    })
})
