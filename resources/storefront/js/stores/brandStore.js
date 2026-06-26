import { useBrand } from '@storefront/composables/useBrand'
import { defineStore } from 'pinia'
const { getBrands } = useBrand()

export const useBrandStore = defineStore('brand', {
    state: () => ({
        brands: [],
        loaded: false,
    }),

    actions: {
        async fetchBrands() {
            if (this.loaded) return

            const rensponse = await getBrands()

            this.brands = rensponse
            this.loaded = true
        },
    },
})
