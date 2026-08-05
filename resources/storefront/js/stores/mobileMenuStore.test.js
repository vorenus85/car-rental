import { describe, it, expect, beforeEach } from 'vitest'
import { createPinia, setActivePinia } from 'pinia'

import { useMobileMenuStore } from '@storefront/stores/mobileMenuStore'

describe('useMobileMenuStore', () => {
    beforeEach(() => {
        setActivePinia(createPinia())
    })

    it('should have default state', () => {
        const store = useMobileMenuStore()

        expect(store.open).toBe(false)
        expect(store.isOpen).toBe(false)
    })

    it('should toggle the menu open state', () => {
        const store = useMobileMenuStore()

        store.toggleMenu()

        expect(store.open).toBe(true)
        expect(store.isOpen).toBe(true)

        store.toggleMenu()

        expect(store.open).toBe(false)
        expect(store.isOpen).toBe(false)
    })

    it('should close the menu', () => {
        const store = useMobileMenuStore()

        store.open = true

        store.closeMenu()

        expect(store.open).toBe(false)
        expect(store.isOpen).toBe(false)
    })
})
