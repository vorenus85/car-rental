import { describe, it, expect, beforeEach } from 'vitest'
import { setActivePinia, createPinia } from 'pinia'

import { useLayoutStore } from '@admin/stores/layout'

describe('Layout Store', () => {
    beforeEach(() => {
        setActivePinia(createPinia())
    })

    describe('initial state', () => {
        it('should have drawer closed by default', () => {
            const store = useLayoutStore()

            expect(store.isDrawerOpen).toBe(false)
        })
    })

    describe('toggleDrawer', () => {
        it('should open drawer when closed', () => {
            const store = useLayoutStore()

            store.toggleDrawer()

            expect(store.isDrawerOpen).toBe(true)
        })

        it('should close drawer when open', () => {
            const store = useLayoutStore()

            store.isDrawerOpen = true

            store.toggleDrawer()

            expect(store.isDrawerOpen).toBe(false)
        })
    })

    describe('openDrawer', () => {
        it('should open drawer', () => {
            const store = useLayoutStore()

            store.openDrawer()

            expect(store.isDrawerOpen).toBe(true)
        })
    })

    describe('closeDrawer', () => {
        it('should close drawer', () => {
            const store = useLayoutStore()

            store.isDrawerOpen = true

            store.closeDrawer()

            expect(store.isDrawerOpen).toBe(false)
        })
    })
})
