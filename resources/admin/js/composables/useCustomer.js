import { useRoute } from 'vue-router'
import {
    fetchCustomers,
    fetchCustomer,
    deleteCustomerById,
    toggleCustomerActive,
    sendPasswordReset,
} from '@admin/services/customerService'
import { useCustomToast } from '@admin/composables/useCustomToast'
import { reactive, ref } from 'vue'

export const useCustomer = () => {
    const loading = ref(false)
    const customers = ref([])
    const allCustomers = ref([])
    const formKey = ref(0)
    const route = useRoute()
    const customerId = route.params.id

    const { customToast } = useCustomToast()

    const initialValues = reactive({
        name: null,
        phone: '',
        email: null,
        active: true,
    })

    const toggleActive = async id => {
        //loading.value = true

        try {
            const { data } = await toggleCustomerActive(id)
            const customerIndex = customers.value.findIndex(el => el.id === id)
            customers.value[customerIndex].active = data.active
            //loading.value = false
        } catch (e) {
            //loading.value = false
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        }
    }

    const getCustomers = async params => {
        loading.value = true

        try {
            const { data } = await fetchCustomers({ ...params })
            allCustomers.value = data
            customers.value = data
            loading.value = false
        } catch (e) {
            loading.value = false
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        }
    }

    const getCustomer = async params => {
        loading.value = true

        try {
            const { data } = await fetchCustomer(customerId, { ...params })
            initialValues.name = data.name
            initialValues.phone = data.phone
            initialValues.email = data.email
            initialValues.active = Boolean(data.active)
            formKey.value++ // to remount primevue/form to trigger form resolver/validation https://github.com/primefaces/primevue/issues/7792
            loading.value = false
        } catch (e) {
            loading.value = false
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        }
    }

    const deleteCustomer = async id => {
        loading.value = true

        try {
            await deleteCustomerById(id)
            const idIndex = customers.value.findIndex(el => {
                return el.id === id
            })
            customers.value.splice(idIndex, 1)

            customToast.success('Customer deleted successfully!')

            loading.value = false
        } catch (e) {
            loading.value = false
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        }
    }

    const doSendPasswordReset = async id => {
        try {
            const { data } = await sendPasswordReset(id)
            customToast.success(data.message)
        } catch (error) {
            void error // to avoid unused variable lint error
            // console.error(error) -- IGNORE --
            const msg = error?.response?.data?.message
            customToast.error(msg || 'Please try again.')
        }
    }

    return {
        toggleActive,
        loading,
        customers,
        allCustomers,
        getCustomers,
        getCustomer,
        deleteCustomer,
        initialValues,
        formKey,
        customerId,
        doSendPasswordReset,
    }
}
