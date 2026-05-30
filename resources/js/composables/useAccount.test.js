import { describe, it, expect, vi, beforeEach } from 'vitest'
import { useAccount } from '@/composables/useAccount'
import { fetchMe } from '@/services/accountService'

vi.mock('@/services/accountService', () => ({
    fetchMe: vi.fn(),
}))

describe('useAccount', () => {
    beforeEach(() => {
        vi.clearAllMocks()
    })

    it('initializes default values', () => {
        const account = useAccount()

        expect(account.initialValues).toEqual({
            name: '',
            email: '',
            phone: '',
        })

        expect(account.formKey.value).toBe(0)
        expect(account.password.value).toBeNull()
        expect(account.password_confirmation.value).toBeNull()
    })

    it('contains account menu items', () => {
        const account = useAccount()

        expect(account.accountMenu.value).toEqual([
            {
                label: 'Profile',
                route: '/account/profile',
            },
            {
                label: 'Password',
                route: '/account/password',
            },
        ])
    })

    it('loads profile data', async () => {
        vi.mocked(fetchMe).mockResolvedValue({
            data: {
                name: 'John Doe',
                email: 'john@example.com',
                phone: '+36123456789',
            },
        })

        const account = useAccount()

        await account.getProfile()

        expect(account.initialValues).toEqual({
            name: 'John Doe',
            email: 'john@example.com',
            phone: '+36123456789',
        })

        expect(account.formKey.value).toBe(1)
    })

    it('increments formKey every time profile is loaded', async () => {
        vi.mocked(fetchMe).mockResolvedValue({
            data: {
                name: 'John Doe',
                email: 'john@example.com',
                phone: '+36123456789',
            },
        })

        const account = useAccount()

        await account.getProfile()
        await account.getProfile()

        expect(account.formKey.value).toBe(2)
    })

    it('handles fetch errors gracefully', async () => {
        vi.mocked(fetchMe).mockRejectedValue(new Error('API error'))

        const account = useAccount()

        await expect(account.getProfile()).resolves.toBeUndefined()

        expect(account.initialValues).toEqual({
            name: '',
            email: '',
            phone: '',
        })

        expect(account.formKey.value).toBe(0)
    })

    it('calls fetchMe once', async () => {
        vi.mocked(fetchMe).mockResolvedValue({
            data: {
                name: 'John Doe',
                email: 'john@example.com',
                phone: '+36123456789',
            },
        })

        const account = useAccount()

        await account.getProfile()

        expect(fetchMe).toHaveBeenCalledTimes(1)
    })
})
