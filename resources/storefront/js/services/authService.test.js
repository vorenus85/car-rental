import { describe, it, expect, vi, beforeEach } from 'vitest'
import axios from 'axios'

import {
    checkAuth,
    getCsrfCookie,
    fetchCustomer,
    doLogout,
    doLogin,
    editBasicDetails,
    editPassword,
    editBillingInfo,
} from '@storefront/services/authService'

vi.mock('axios')

describe('authService', () => {
    beforeEach(() => {
        vi.clearAllMocks()
    })

    describe('checkAuth', () => {
        it('should call GET /storefront/auth/check', async () => {
            axios.get.mockResolvedValue({
                data: { authenticated: true },
            })

            const response = await checkAuth()

            expect(axios.get).toHaveBeenCalledWith('/storefront/auth/check')
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

    describe('fetchCustomer', () => {
        it('should call GET /storefront/auth/me with credentials', async () => {
            axios.get.mockResolvedValue({
                data: {
                    customer: {
                        id: 1,
                        firstName: 'John',
                        lastName: 'Doe',
                        email: 'john@example.com',
                    },
                },
            })

            const response = await fetchCustomer()

            expect(axios.get).toHaveBeenCalledWith('/storefront/auth/me', {
                withCredentials: true,
            })

            expect(response.data.customer.firstName).toBe('John')
        })
    })

    describe('doLogout', () => {
        it('should call POST /storefront/auth/logout', async () => {
            axios.post.mockResolvedValue({
                data: {
                    success: true,
                },
            })

            const response = await doLogout()

            expect(axios.post).toHaveBeenCalledWith('/storefront/auth/logout', null, {
                withCredentials: true,
            })

            expect(response.data.success).toBe(true)
        })
    })

    describe('doLogin', () => {
        it('should call POST /storefront/auth/login with credentials', async () => {
            axios.post.mockResolvedValue({
                data: {
                    token: 'fake-token',
                },
            })

            const response = await doLogin('john@example.com', 'password123')

            expect(axios.post).toHaveBeenCalledWith(
                '/storefront/auth/login',
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

    describe('editBasicDetails', () => {
        it('should call PATCH /api/storefront/profile/basic-details with credentials', async () => {
            axios.patch.mockResolvedValue({
                data: {
                    message: 'Basic details updated successfully.',
                },
            })

            const response = await editBasicDetails({
                firstName: 'Jane',
                lastName: 'Smith',
                phone: '+36 20 987 6543',
                email: 'jane@example.com',
            })

            expect(axios.patch).toHaveBeenCalledWith(
                '/api/storefront/profile/basic-details',
                {
                    firstName: 'Jane',
                    lastName: 'Smith',
                    phone: '+36 20 987 6543',
                    email: 'jane@example.com',
                },
                {
                    withCredentials: true,
                }
            )

            expect(response.data.message).toBe('Basic details updated successfully.')
        })
    })

    describe('editPassword', () => {
        it('should call PATCH /api/storefront/profile/password with credentials', async () => {
            axios.patch.mockResolvedValue({
                data: {
                    message: 'Password changed successfully.',
                },
            })

            const response = await editPassword({
                current_password: 'oldpassword',
                password: 'newpassword123',
                password_confirmation: 'newpassword123',
            })

            expect(axios.patch).toHaveBeenCalledWith(
                '/api/storefront/profile/password',
                {
                    current_password: 'oldpassword',
                    password: 'newpassword123',
                    password_confirmation: 'newpassword123',
                },
                {
                    withCredentials: true,
                }
            )

            expect(response.data.message).toBe('Password changed successfully.')
        })
    })

    describe('editBillingInfo', () => {
        it('should call PATCH /api/storefront/profile/billing-info with credentials', async () => {
            axios.patch.mockResolvedValue({
                data: {
                    message: 'Billing info updated successfully.',
                },
            })

            const response = await editBillingInfo({
                name: 'ACME Ltd.',
                country: 'HU',
                postcode: '1051',
                city: 'Budapest',
                address: 'Kossuth Lajos utca 1.',
                company_name: 'ACME Ltd.',
                tax_number: '12345678-1-42',
                eu_vat_number: 'HU12345678',
            })

            expect(axios.patch).toHaveBeenCalledWith(
                '/api/storefront/profile/billing-info',
                {
                    name: 'ACME Ltd.',
                    country: 'HU',
                    postcode: '1051',
                    city: 'Budapest',
                    address: 'Kossuth Lajos utca 1.',
                    company_name: 'ACME Ltd.',
                    tax_number: '12345678-1-42',
                    eu_vat_number: 'HU12345678',
                },
                {
                    withCredentials: true,
                }
            )

            expect(response.data.message).toBe('Billing info updated successfully.')
        })
    })
})
