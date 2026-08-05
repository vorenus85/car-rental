import { describe, it, expect, vi, beforeEach } from 'vitest'
import axios from 'axios'

import {
    fetchCustomers,
    fetchCustomer,
    deleteCustomerById,
    createCustomer,
    updateCustomerById,
    toggleCustomerActive,
    sendPasswordReset,
} from '@admin/services/customerService'

vi.mock('axios')

describe('customerService', () => {
    beforeEach(() => {
        vi.clearAllMocks()
    })

    it('fetchCustomers calls GET /api/admin/customers with params', async () => {
        const params = {
            page: 2,
            search: 'john',
        }

        axios.get.mockResolvedValue({ data: [] })

        await fetchCustomers(params)

        expect(axios.get).toHaveBeenCalledWith('/api/admin/customers', { params })
    })

    it('fetchCustomers calls GET /api/admin/customers without params', async () => {
        axios.get.mockResolvedValue({ data: [] })

        await fetchCustomers()

        expect(axios.get).toHaveBeenCalledWith('/api/admin/customers', { params: {} })
    })

    it('fetchCustomer calls GET customer endpoint', async () => {
        axios.get.mockResolvedValue({ data: {} })

        await fetchCustomer(15)

        expect(axios.get).toHaveBeenCalledWith('/api/admin/customers/15', { params: {} })
    })

    it('fetchCustomer passes params', async () => {
        const params = {
            include: 'bookings',
        }

        axios.get.mockResolvedValue({ data: {} })

        await fetchCustomer(15, params)

        expect(axios.get).toHaveBeenCalledWith('/api/admin/customers/15', { params })
    })

    it('deleteCustomerById calls DELETE endpoint', async () => {
        axios.delete.mockResolvedValue({})

        await deleteCustomerById(10)

        expect(axios.delete).toHaveBeenCalledWith('/api/admin/customers/10')
    })

    it('createCustomer calls POST endpoint', async () => {
        const payload = {
            first_name: 'John',
            last_name: 'Doe',
            email: 'john@example.com',
        }

        axios.post.mockResolvedValue({})

        await createCustomer(payload)

        expect(axios.post).toHaveBeenCalledWith('/api/admin/customers', payload)
    })

    it('updateCustomerById calls PUT endpoint', async () => {
        const payload = {
            first_name: 'Updated',
            last_name: 'Customer',
        }

        axios.put.mockResolvedValue({})

        await updateCustomerById(5, payload)

        expect(axios.put).toHaveBeenCalledWith('/api/admin/customers/5', payload)
    })

    it('toggleCustomerActive calls toggle endpoint', async () => {
        axios.put.mockResolvedValue({})

        await toggleCustomerActive(5)

        expect(axios.put).toHaveBeenCalledWith('/api/admin/customers/5/toggle-active')
    })

    it('sendPasswordReset calls reset endpoint', async () => {
        axios.post.mockResolvedValue({})

        await sendPasswordReset(5)

        expect(axios.post).toHaveBeenCalledWith('/api/admin/customers/5/send-password-reset')
    })
})
