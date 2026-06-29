import { defineStore } from 'pinia'
import { getCsrfCookie, fetchUser, doLogout, doLogin } from '@admin/services/authService'

export const useAuthStore = defineStore('auth', {
    state: () => ({
        user: null,
        loaded: false,
    }),
    actions: {
        async getUser() {
            try {
                const res = await fetchUser()
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
            this.user = res.data.user
        },
        async logout() {
            await doLogout()
            this.user = null
            this.loaded = false
        },
    },
})
