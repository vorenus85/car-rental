import axios from 'axios'
import {
    fetchVariants,
    fetchVariant,
    deleteVariantById,
    createVariant,
    updateVariantById,
} from '@/services/variantService'
import { afterEach, describe, expect, it, vi } from 'vitest'

vi.mock('axios')

describe('variantService', () => {
    afterEach(() => {
        vi.clearAllMocks()
    })

    it('fetchVariants calls correct endpoint', async () => {
        axios.get.mockResolvedValue({
            data: [],
        })

        await fetchVariants()

        expect(axios.get).toHaveBeenCalledWith('/api/admin/variants')
    })

    it('fetchVariant calls correct endpoint', async () => {
        axios.get.mockResolvedValue({
            data: {},
        })

        await fetchVariant(1)

        expect(axios.get).toHaveBeenCalledWith('/api/admin/variants/1')
    })

    it('deleteVariantById calls correct endpoint', async () => {
        axios.delete.mockResolvedValue({
            data: {},
        })

        await deleteVariantById(1)

        expect(axios.delete).toHaveBeenCalledWith('/api/admin/variants/1')
    })

    it('createVariant sends payload correctly', async () => {
        const values = {
            name: 'Sport',
            description: 'Sport variant with enhanced performance',
            brand: 'BMW',
            model: 'M3',
            category: 'sedan',
            bodyType: 'coupe',
            transmission: 'manual',
            fuelType: 'petrol',
            seats: 4,
            doors: 2,
            features: [1, 2, 3],
        }

        axios.post.mockResolvedValue({
            data: values,
        })

        await createVariant(values)

        expect(axios.post).toHaveBeenCalledWith('/api/admin/variants', values)
    })

    it('updateVariantById sends payload correctly', async () => {
        const values = {
            name: 'Sport',
            description: 'Sport variant with enhanced performance',
            brand: 'BMW',
            model: 'M3',
            category: 'sedan',
            bodyType: 'coupe',
            transmission: 'manual',
            fuelType: 'petrol',
            seats: 4,
            doors: 2,
            features: [1, 2, 3],
        }

        axios.put.mockResolvedValue({
            data: values,
        })

        await updateVariantById(1, values)

        expect(axios.put).toHaveBeenCalledWith('/api/admin/variants/1', values)
    })
})
