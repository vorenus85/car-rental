import { useRoute } from 'vue-router'

import {
    fetchCarDrivers,
    fetchCarDriver,
    deleteCarDriverById,
} from '@admin/services/carDriverService'
import { useCustomToast } from '@admin/composables/useCustomToast'
import { reactive, ref } from 'vue'

export const useCarDriver = () => {
    const loading = ref(false)
    const carDrivers = ref([])
    const allCarDrivers = ref([])
    const formKey = ref(0)
    const route = useRoute()
    const carDriverId = route.params.id

    const { customToast } = useCustomToast()

    const initialValues = reactive({
        firstName: null,
        lastName: null,
        phone: '',
        birthDate: null,
        licenceNumber: null,
        licenceCountry: null,
        licenceIssueDate: null,
        licenceExpiryDate: null,
    })

    const maxBirthDate = new Date()
    maxBirthDate.setFullYear(maxBirthDate.getFullYear() - 25)

    const maxLicenceDate = new Date()
    maxLicenceDate.setFullYear(maxLicenceDate.getFullYear() - 2)

    const getCarDrivers = async params => {
        loading.value = true

        try {
            const { data } = await fetchCarDrivers({ ...params })
            allCarDrivers.value = data
            carDrivers.value = data
            loading.value = false
        } catch (e) {
            loading.value = false
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        }
    }

    const getCarDriver = async params => {
        loading.value = true

        try {
            const { data } = await fetchCarDriver(carDriverId, { ...params })
            // console.log(data)

            initialValues.firstName = data.firstName
            initialValues.lastName = data.lastName
            initialValues.phone = data.phone
            initialValues.birthDate = data.birthDate ? new Date(data.birthDate) : null
            initialValues.licenceNumber = data.licenceNumber
            initialValues.licenceCountry = data.licenceCountry
            initialValues.licenceIssueDate = data.licenceIssueDate
                ? new Date(data.licenceIssueDate)
                : null
            initialValues.licenceExpiryDate = data.licenceExpiryDate
                ? new Date(data.licenceExpiryDate)
                : null

            formKey.value++ // to remount primevue/form to trigger form resolver/validation https://github.com/primefaces/primevue/issues/7792
            loading.value = false
        } catch (e) {
            loading.value = false
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        }
    }

    const deleteCarDriver = async id => {
        loading.value = true

        try {
            await deleteCarDriverById(id)
            const idIndex = carDrivers.value.findIndex(el => {
                return el.id === id
            })
            carDrivers.value.splice(idIndex, 1)

            customToast.success('Car driver deleted successfully!')

            loading.value = false
        } catch (e) {
            loading.value = false
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        }
    }

    return {
        loading,
        carDrivers,
        allCarDrivers,
        getCarDrivers,
        getCarDriver,
        deleteCarDriver,
        initialValues,
        formKey,
        carDriverId,
        maxBirthDate,
        maxLicenceDate,
    }
}
