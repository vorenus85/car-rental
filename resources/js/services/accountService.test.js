import axios from 'axios'
import { fetchMe, updateMe, updatePassword } from '@/services/accountService'
import { afterEach, describe, expect, it, vi } from 'vitest'

vi.mock('axios')

describe('accountService', () => {
    afterEach(() => {
        vi.clearAllMocks()
    })

    it('fetchMe calls correct endpoint', async () => {
        axios.get.mockResolvedValue()

        await fetchMe()

        expect(axios.get).toHaveBeenCalledWith('/api/admin/account/me')
    })

    it('updateMe calls correct endpoint', async () => {
        axios.put.mockResolvedValue()

        const values = { name: 'New Name', email: 'new@email.hu', phone: '0123456789' }

        await updateMe(values)

        expect(axios.put).toHaveBeenCalledWith('/api/admin/account/me', values)
    })

    it('updatePassword calls correct endpoint', async () => {
        axios.put.mockResolvedValue()

        const values = { password: '0123456789', newPassword: '11111111' }

        await updatePassword(values)

        expect(axios.put).toHaveBeenCalledWith('/api/admin/account/password', values)
    })
})
