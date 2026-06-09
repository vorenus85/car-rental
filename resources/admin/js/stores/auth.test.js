import { describe, it, expect, vi, beforeEach } from 'vitest'
import { setActivePinia, createPinia } from 'pinia'

import { useAuthStore } from '@admin/stores/auth'

import { getCsrfCookie, fetchUser, doLogout, doLogin } from '@admin/services/authService'

vi.mock('@admin/services/authService', () => ({
    getCsrfCookie: vi.fn(),
    fetchUser: vi.fn(),
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

    describe('fetchUser', () => {
        it('should fetch and set user', async () => {
            const mockUser = {
                id: 1,
                name: 'John Doe',
                email: 'john@example.com',
            }

            fetchUser.mockResolvedValue({
                data: mockUser,
            })

            const store = useAuthStore()

            await store.fetchUser()

            expect(fetchUser).toHaveBeenCalled()

            expect(store.user).toEqual(mockUser)
            expect(store.loaded).toBe(true)
        })

        it('should set user to null on error', async () => {
            fetchUser.mockRejectedValue(new Error('Unauthorized'))

            const store = useAuthStore()

            await store.fetchUser()

            expect(fetchUser).toHaveBeenCalled()

            expect(store.user).toBe(null)
            expect(store.loaded).toBe(true)
        })
    })

    describe('login', () => {
        it('should get csrf cookie and login user', async () => {
            const mockUser = {
                id: 1,
                name: 'John Doe',
            }

            getCsrfCookie.mockResolvedValue({})

            doLogin.mockResolvedValue({
                data: {
                    user: mockUser,
                },
            })

            const store = useAuthStore()

            await store.login('john@example.com', 'password123')

            expect(getCsrfCookie).toHaveBeenCalled()

            expect(doLogin).toHaveBeenCalledWith('john@example.com', 'password123')

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
