import { useBrandStore } from '@storefront/stores/useBrandStore'
import { computed } from 'vue'

export const useCarFilters = () => {
    const brandStore = useBrandStore()

    const filterParams = computed(() => {
        return {
            carTypes: [
                { label: 'SUV', value: 'suv' },
                { label: 'Sedan', value: 'sedan' },
                { label: 'Hatchback', value: 'hatchback' },
                { label: 'Coupe', value: 'coupe' },
                { label: 'Wagon', value: 'wagon' },
            ],
            transmissions: [
                { label: 'Automatic', value: 'automatic' },
                { label: 'Manual', value: 'manual' },
            ],
            fuelTypes: [
                { label: 'Petrol', value: 'petrol' },
                { label: 'Diesel', value: 'diesel' },
                { label: 'Hybrid', value: 'hybrid' },
                { label: 'Electric', value: 'electric' },
            ],
            seats: [
                { label: '2', value: 2 },
                { label: '4', value: 4 },
                { label: '5', value: 5 },
                { label: '6', value: 6 },
            ],

            luggageCounts: [
                { label: '1', value: 1 },
                { label: '2', value: 2 },
                { label: '3', value: 3 },
                { label: '4', value: 4 },
                { label: '5', value: 5 },
            ],
            brands: brandStore.brands,
        }
    })

    return {
        filterParams,
    }
}
