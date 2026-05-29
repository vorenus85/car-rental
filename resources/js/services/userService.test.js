import { describe, it, expect, vi, beforeEach } from 'vitest'
import axios from 'axios'

import {
    fetchUsers,
    fetchUser,
    deleteUserById,
    createUser,
    updateUserById,
    toggleUserActive,
} from '@/services/userService'

vi.mock('axios')

describe('userService', () => {
    beforeEach(() => {
        vi.clearAllMocks()
    })

    it('fetchUsers calls GET /api/admin/users with params', async () => {
        const params = {
            page: 2,
            search: 'john',
        }

        axios.get.mockResolvedValue({ data: [] })

        await fetchUsers(params)

        expect(axios.get).toHaveBeenCalledWith('/api/admin/users', { params })
    })

    it('fetchUsers calls GET /api/admin/users without params', async () => {
        axios.get.mockResolvedValue({ data: [] })

        await fetchUsers()

        expect(axios.get).toHaveBeenCalledWith('/api/admin/users', { params: {} })
    })

    it('fetchUser calls GET user endpoint', async () => {
        axios.get.mockResolvedValue({ data: {} })

        await fetchUser(15)

        expect(axios.get).toHaveBeenCalledWith('/api/admin/users/15', { params: {} })
    })

    it('fetchUser passes params', async () => {
        const params = {
            include: 'roles',
        }

        axios.get.mockResolvedValue({ data: {} })

        await fetchUser(15, params)

        expect(axios.get).toHaveBeenCalledWith('/api/admin/users/15', { params })
    })

    it('deleteUserById calls DELETE endpoint', async () => {
        axios.delete.mockResolvedValue({})

        await deleteUserById(10)

        expect(axios.delete).toHaveBeenCalledWith('/api/admin/users/10')
    })

    it('createUser calls POST endpoint', async () => {
        const payload = {
            name: 'John Doe',
            email: 'john@example.com',
        }

        axios.post.mockResolvedValue({})

        await createUser(payload)

        expect(axios.post).toHaveBeenCalledWith('/api/admin/users', payload)
    })

    it('updateUserById calls PUT endpoint', async () => {
        const payload = {
            name: 'Updated User',
        }

        axios.put.mockResolvedValue({})

        await updateUserById(5, payload)

        expect(axios.put).toHaveBeenCalledWith('/api/admin/users/5', payload)
    })

    it('toggleUserActive calls toggle endpoint', async () => {
        axios.put.mockResolvedValue({})

        await toggleUserActive(5)

        expect(axios.put).toHaveBeenCalledWith('/api/admin/users/5/toggle-active')
    })
})
