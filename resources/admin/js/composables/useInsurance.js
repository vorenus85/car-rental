import {
    fetchInsurances,
    deleteInsuranceById,
    fetchInsurance,
} from '@admin/services/insuranceService'
import { useCustomToast } from '@admin/composables/useCustomToast'
import { reactive, ref } from 'vue'
import { useRoute } from 'vue-router'

export const useInsurance = () => {
    const loading = ref(false)
    const insurances = ref([])
    const formKey = ref(0)
    const route = useRoute()
    const insuranceId = route.params.id

    const { customToast } = useCustomToast()

    const initialValues = reactive({
        name: '',
        description: '',
        price: '',
        recommended: false,
    })

    const getInsurances = async () => {
        loading.value = true

        try {
            const { data } = await fetchInsurances()
            insurances.value = data
        } catch (e) {
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        } finally {
            loading.value = false
        }
    }

    const getInsurance = async () => {
        loading.value = true

        try {
            const { data } = await fetchInsurance(insuranceId)
            initialValues.name = data.name
            initialValues.description = data.description
            initialValues.price = data.price
            initialValues.recommended = Boolean(data.recommended)
            formKey.value++ // to remount primevue/form to trigger form resolver/validation https://github.com/primefaces/primevue/issues/7792
        } catch (e) {
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        } finally {
            loading.value = false
        }
    }

    const deleteInsurance = async id => {
        loading.value = true

        try {
            await deleteInsuranceById(id)
            const idIndex = insurances.value.findIndex(el => {
                return el.id === id
            })
            insurances.value.splice(idIndex, 1)

            customToast.success('Insurance deleted successfully!')
        } catch (e) {
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        } finally {
            loading.value = false
        }
    }

    return {
        insurances,
        getInsurance,
        getInsurances,
        deleteInsurance,
        initialValues,
        loading,
        formKey,
        insuranceId,
    }
}
