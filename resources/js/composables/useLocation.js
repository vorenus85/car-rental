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

    const groupedCities = ref([
        {
            label: 'Hungary',
            code: 'hu',
            items: [{ code: 'hu', label: 'Budapest', value: 'Budapest' }],
        },
        {
            label: 'Austria',
            code: 'at',
            items: [{ code: 'at', label: 'Vienna', value: 'Vienna' }],
        },
        {
            label: 'Czech Republic',
            code: 'cz',
            items: [{ code: 'cz', label: 'Prague', value: 'Prague' }],
        },
    ])

    function createTime(hour, minute = 0) {
        const date = new Date()
        date.setHours(hour, minute, 0, 0)

        return date
    }

    const initialValues = reactive({
        name: '',
        city_country: '',
        address: '',
        type: '',
        phone: '',
        email: '',
        business_hours: {
            monday: {
                label: 'Monday',
                enabled: true,
                open: createTime(6),
                close: createTime(22),
            },
            tuesday: {
                label: 'Tuesday',
                enabled: true,
                open: createTime(6),
                close: createTime(22),
            },
            wednesday: {
                label: 'Wednesday',
                enabled: true,
                open: createTime(6),
                close: createTime(22),
            },
            thursday: {
                label: 'Thursday',
                enabled: true,
                open: createTime(6),
                close: createTime(22),
            },
            friday: {
                label: 'Friday',
                enabled: true,
                open: createTime(6),
                close: createTime(22),
            },
            saturday: {
                label: 'Saturday',
                enabled: false,
                open: createTime(8),
                close: createTime(18),
            },
            sunday: {
                label: 'Sunday',
                enabled: false,
                open: createTime(8),
                close: createTime(18),
            },
        },
        description: null,
        is_active: true,
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
        { id: 'airport', label: 'Airport' },
        { id: 'railway_station', label: 'Railway Station' },
        { id: 'city_center', label: 'City Center' },
        { id: 'office', label: 'Office' },
        { id: 'hotel', label: 'Hotel' },
        { id: 'other', label: 'Other' },
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
        groupedCities,
    }
}
