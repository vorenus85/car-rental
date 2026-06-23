import { computed, ref } from 'vue'
import { fetchCar } from '@storefront/services/carService.js'
import { useCarFilters } from '@storefront/composables/useCarFilters'

export const useCar = () => {
    const { filterParams } = useCarFilters()
    const loadingCar = ref(false)
    const car = ref({})

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

    return {
        loadingCar,
        getCar,
        car,
        bodyType,
    }
}
