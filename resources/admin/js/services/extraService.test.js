import axios from 'axios'
import {
    fetchExtras,
    fetchExtra,
    deleteExtraById,
    createExtra,
    updateExtraById,
} from '@admin/services/extraService'
import { afterEach, describe, expect, it, vi } from 'vitest'

vi.mock('axios')

describe('extraService', () => {
    afterEach(() => {
        vi.clearAllMocks()
    })

    it('fetchExtras calls correct endpoint', async () => {
        axios.get.mockResolvedValue({
            data: [],
        })

        await fetchExtras()

        expect(axios.get).toHaveBeenCalledWith('/api/admin/extras')
    })

    it('fetchExtra calls correct endpoint', async () => {
        axios.get.mockResolvedValue({
            data: {},
        })

        await fetchExtra(1)

        expect(axios.get).toHaveBeenCalledWith('/api/admin/extras/1')
    })

    it('deleteExtraById calls correct endpoint', async () => {
        axios.delete.mockResolvedValue({
            data: {},
        })

        await deleteExtraById(1)

        expect(axios.delete).toHaveBeenCalledWith('/api/admin/extras/1')
    })

    it('createExtra sends payload correctly', async () => {
        const values = {
            name: 'GPS',
            price: 10,
        }

        axios.post.mockResolvedValue({
            data: values,
        })

        await createExtra(values)

        expect(axios.post).toHaveBeenCalledWith('/api/admin/extras', values)
    })

    it('updateExtraById sends payload correctly', async () => {
        const values = {
            name: 'Child seat',
            price: 15,
        }

        axios.put.mockResolvedValue({
            data: values,
        })

        await updateExtraById(1, values)

        expect(axios.put).toHaveBeenCalledWith('/api/admin/extras/1', values)
    })
})
