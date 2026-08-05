import axios from 'axios'
import {
    fetchInsurances,
    fetchInsurance,
    deleteInsuranceById,
    createInsurance,
    updateInsuranceById,
} from '@admin/services/insuranceService'
import { afterEach, describe, expect, it, vi } from 'vitest'

vi.mock('axios')

describe('insuranceService', () => {
    afterEach(() => {
        vi.clearAllMocks()
    })

    it('fetchInsurances calls correct endpoint', async () => {
        axios.get.mockResolvedValue({
            data: [],
        })

        await fetchInsurances()

        expect(axios.get).toHaveBeenCalledWith('/api/admin/insurances')
    })

    it('fetchInsurance calls correct endpoint', async () => {
        axios.get.mockResolvedValue({
            data: {},
        })

        await fetchInsurance(1)

        expect(axios.get).toHaveBeenCalledWith('/api/admin/insurances/1')
    })

    it('deleteInsuranceById calls correct endpoint', async () => {
        axios.delete.mockResolvedValue({
            data: {},
        })

        await deleteInsuranceById(1)

        expect(axios.delete).toHaveBeenCalledWith('/api/admin/insurances/1')
    })

    it('createInsurance sends payload correctly', async () => {
        const values = {
            name: 'Full coverage',
            price: 25,
            description: 'Complete protection package',
        }

        axios.post.mockResolvedValue({
            data: values,
        })

        await createInsurance(values)

        expect(axios.post).toHaveBeenCalledWith('/api/admin/insurances', values)
    })

    it('updateInsuranceById sends payload correctly', async () => {
        const values = {
            name: 'Basic coverage',
            price: 15,
            description: 'Updated description',
        }

        axios.put.mockResolvedValue({
            data: values,
        })

        await updateInsuranceById(1, values)

        expect(axios.put).toHaveBeenCalledWith('/api/admin/insurances/1', values)
    })
})
