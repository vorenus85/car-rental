import { computed, ref } from 'vue'
import { fetchCar, fetchAvailability } from '@storefront/services/carService.js'
import { useCarFilters } from '@storefront/composables/useCarFilters'

export const useCar = () => {
    const { filterParams } = useCarFilters()
    const loadingCar = ref(false)
    const car = ref({})
    const availability = ref([])

    const bodyType = computed(() => {
        return filterParams.value.carTypes?.find(item => car.value.bodyType === item.value)
    })

    const getCar = async id => {
        loadingCar.value = true
        try {
            const { data } = await fetchCar(id)
            car.value = data.data
        } catch (error) {
            console.log(error)
        } finally {
            loadingCar.value = false
        }
    }

    const getAvailability = async id => {
        loadingCar.value = true
        try {
            const { data } = await fetchAvailability(id)
            availability.value = data.days
        } catch (error) {
            console.log(error)
        } finally {
            loadingCar.value = false
        }
    }

    return {
        loadingCar,
        getCar,
        getAvailability,
        availability,
        car,
        bodyType,
    }
}
