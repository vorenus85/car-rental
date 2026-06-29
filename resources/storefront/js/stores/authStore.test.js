import { describe, it, expect, vi, beforeEach } from 'vitest'
import { setActivePinia, createPinia } from 'pinia'

import { useAuthStore } from '@storefront/stores/authStore'

import { getCsrfCookie, fetchCustomer, doLogout, doLogin } from '@storefront/services/authService'

vi.mock('@storefront/services/authService', () => ({
    getCsrfCookie: vi.fn(),
    fetchCustomer: vi.fn(),
    doLogout: vi.fn(),
    doLogin: vi.fn(),
}))

describe('Auth Store', () => {
    beforeEach(() => {
        setActivePinia(createPinia())
        vi.clearAllMocks()
    })

    describe('initial state', () => {
        it('should have default state', () => {
            const store = useAuthStore()

            expect(store.user).toBe(null)
            expect(store.loaded).toBe(false)
        })
    })

    describe('fetchCustomer', () => {
        it('should fetch and set user', async () => {
            const mockUser = {
                id: 1,
                name: 'John Doe',
                email: 'john@example.com',
            }

            fetchCustomer.mockResolvedValue({
                data: mockUser,
            })

            const store = useAuthStore()

            await store.getCustomer()

            expect(fetchCustomer).toHaveBeenCalled()

            expect(store.user).toEqual(mockUser)
            expect(store.loaded).toBe(true)
        })

        it('should set user to null on error', async () => {
            fetchCustomer.mockRejectedValue(new Error('Unauthorized'))

            const store = useAuthStore()

            await store.getCustomer()

            expect(fetchCustomer).toHaveBeenCalled()

            expect(store.user).toBe(null)
            expect(store.loaded).toBe(false)
        })
    })

    describe('login', () => {
        it('should get csrf cookie and login customer', async () => {
            const mockUser = {
                id: 1,
                name: 'John Doe',
            }

            getCsrfCookie.mockResolvedValue({})

            doLogin.mockResolvedValue({
                data: {
                    customer: mockUser,
                },
            })

            const store = useAuthStore()

            await store.login('john@example.com', 'password123')

            expect(getCsrfCookie).toHaveBeenCalled()

            expect(doLogin).toHaveBeenCalledWith('john@example.com', 'password123')

            console.log('store.user', store)

            expect(store.user).toEqual(mockUser)
        })
    })

    describe('logout', () => {
        it('should logout and clear user', async () => {
            doLogout.mockResolvedValue({})

            const store = useAuthStore()

            store.user = {
                id: 1,
                name: 'John Doe',
            }

            await store.logout()

            expect(doLogout).toHaveBeenCalled()

            expect(store.user).toBe(null)
        })
    })
})
