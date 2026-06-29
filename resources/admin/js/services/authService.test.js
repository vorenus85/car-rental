import { describe, it, expect, vi, beforeEach } from 'vitest'
import axios from 'axios'

import { checkAuth, getCsrfCookie, fetchUser, doLogout, doLogin } from '@admin/services/authService'

vi.mock('axios')

describe('authService', () => {
    beforeEach(() => {
        vi.clearAllMocks()
    })

    describe('checkAuth', () => {
        it('should call GET /admin/auth/check', async () => {
            axios.get.mockResolvedValue({
                data: { authenticated: true },
            })

            const response = await checkAuth()

            expect(axios.get).toHaveBeenCalledWith('/admin/auth/check')
            expect(response.data.authenticated).toBe(true)
        })
    })

    describe('getCsrfCookie', () => {
        it('should call GET /sanctum/csrf-cookie with credentials', async () => {
            axios.get.mockResolvedValue({
                data: {},
            })

            await getCsrfCookie()

            expect(axios.get).toHaveBeenCalledWith('/sanctum/csrf-cookie', {
                withCredentials: true,
            })
        })
    })

    describe('fetchUser', () => {
        it('should call GET /admin/auth/me with credentials', async () => {
            axios.get.mockResolvedValue({
                data: {
                    id: 1,
                    name: 'John Doe',
                },
            })

            const response = await fetchUser()

            expect(axios.get).toHaveBeenCalledWith('/admin/auth/me', {
                withCredentials: true,
            })

            expect(response.data.name).toBe('John Doe')
        })
    })

    describe('doLogout', () => {
        it('should call POST /admin/auth/logout', async () => {
            axios.post.mockResolvedValue({
                data: {
                    success: true,
                },
            })

            const response = await doLogout()

            expect(axios.post).toHaveBeenCalledWith('/admin/auth/logout', null, {
                withCredentials: true,
            })

            expect(response.data.success).toBe(true)
        })
    })

    describe('doLogin', () => {
        it('should call POST /admin/auth/login with credentials', async () => {
            axios.post.mockResolvedValue({
                data: {
                    token: 'fake-token',
                },
            })

            const response = await doLogin('john@example.com', 'password123')

            expect(axios.post).toHaveBeenCalledWith(
                '/admin/auth/login',
                {
                    email: 'john@example.com',
                    password: 'password123',
                },
                {
                    withCredentials: true,
                }
            )

            expect(response.data.token).toBe('fake-token')
        })
    })
})
