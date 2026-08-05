import { describe, it, expect, vi, beforeEach } from 'vitest'
import { createPinia, setActivePinia } from 'pinia'

const { getBrandsMock } = vi.hoisted(() => ({
    getBrandsMock: vi.fn(),
}))

vi.mock('@storefront/composables/useBrand', () => ({
    useBrand: () => ({
        getBrands: getBrandsMock,
    }),
}))

import { useBrandStore } from '@storefront/stores/brandStore'

describe('useBrandStore', () => {
    beforeEach(() => {
        setActivePinia(createPinia())
        vi.clearAllMocks()
    })

    it('should have default state', () => {
        const store = useBrandStore()

        expect(store.brands).toEqual([])
        expect(store.loaded).toBe(false)
    })

    it('should fetch brands and set loaded state', async () => {
        const brands = [
            { id: 1, name: 'BMW' },
            { id: 2, name: 'Toyota' },
        ]

        getBrandsMock.mockResolvedValue(brands)

        const store = useBrandStore()

        await store.fetchBrands()

        expect(getBrandsMock).toHaveBeenCalledTimes(1)
        expect(store.brands).toEqual(brands)
        expect(store.loaded).toBe(true)
    })

    it('should not fetch brands again when already loaded', async () => {
        const store = useBrandStore()
        store.loaded = true

        await store.fetchBrands()

        expect(getBrandsMock).not.toHaveBeenCalled()
        expect(store.brands).toEqual([])
        expect(store.loaded).toBe(true)
    })
})
