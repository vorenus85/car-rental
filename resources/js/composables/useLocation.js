import { fetchLocations, deleteLocationById, fetchLocation } from '@/services/locationService'
import { useCustomToast } from '@/composables/useCustomToast'
import { reactive, ref, computed } from 'vue'
import { useRoute } from 'vue-router'

export const useLocation = () => {
    const loading = ref(false)
    const locations = ref([])
    const formKey = ref(0)
    const route = useRoute()
    const locationId = route.params.id

    const { customToast } = useCustomToast()

    const initialValues = reactive({
        name: '',
        description: '',
        category: '',
    })

    const countriesMap = {
        hu: 'Hungary',
        at: 'Austria',
        cz: 'Czech Republic',
    }

    const locationTypeMap = {
        airport: 'Airport',
        railway_station: 'Railway Station',
        city_center: 'City Center',
        office: 'Office',
        hotel: 'Hotel',
        other: 'Other',
    }

    const locationTypes = [
        { id: 'airport', name: 'Airport' },
        { id: 'railway_station', name: 'Railway Station' },
        { id: 'city_center', name: 'City Center' },
        { id: 'office', name: 'Office' },
        { id: 'hotel', name: 'Hotel' },
        { id: 'other', name: 'Other' },
    ]

    const getLocations = async () => {
        loading.value = true

        try {
            const { data } = await fetchLocations()
            locations.value = data
        } catch (e) {
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        } finally {
            loading.value = false
        }
    }

    const getLocation = async () => {
        loading.value = true

        try {
            const { data } = await fetchLocation(locationId)
            initialValues.name = data.name
            initialValues.description = data.description
            initialValues.category = data.category
            formKey.value++ // to remount primevue/form to trigger form resolver/validation https://github.com/primefaces/primevue/issues/7792
        } catch (e) {
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        } finally {
            loading.value = false
        }
    }

    const deleteLocation = async id => {
        loading.value = true

        try {
            await deleteLocationById(id)
            const idIndex = locations.value.findIndex(el => {
                return el.id === id
            })
            locations.value.splice(idIndex, 1)

            customToast.success('Location deleted successfully!')
        } catch (e) {
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        } finally {
            loading.value = false
        }
    }

    return {
        locations,
        getLocation,
        getLocations,
        deleteLocation,
        initialValues,
        loading,
        formKey,
        locationId,
        locationTypes,
        countriesMap,
        locationTypeMap,
    }
}
