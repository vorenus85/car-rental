import { defineStore } from 'pinia'

export const useMobileMenuStore = defineStore('mobileMenu', {
    state: () => ({
        open: false,
    }),
    actions: {
        toggleMenu() {
            this.open = !this.open
        },
        closeMenu() {
            this.open = false
        },
    },
    getters: {
        isOpen: state => state.open,
    },
})
