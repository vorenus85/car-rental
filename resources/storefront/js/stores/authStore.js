import { defineStore } from 'pinia'
import { getCsrfCookie, fetchCustomer, doLogout, doLogin } from '@storefront/services/authService'

export const useAuthStore = defineStore('customerAuth', {
    state: () => ({
        user: null,
        loaded: false,
    }),
    actions: {
        async getCustomer() {
            try {
                const res = await fetchCustomer()
                this.user = res?.data
                this.loaded = true
            } catch {
                this.user = null
                this.loaded = false
            }
        },
        async login(email, password) {
            await getCsrfCookie()
            const res = await doLogin(email, password)

            this.user = res.data.customer
        },
        async init() {
            if (this.loaded) return

            try {
                await this.getCustomer()
            } finally {
                this.loaded = true
            }
        },
        async logout() {
            await doLogout()
            this.user = null
            this.loaded = false
        },
    },
})
