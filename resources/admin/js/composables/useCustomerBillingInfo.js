import { useRoute } from 'vue-router'

import { fetchCustomerBillingInfo } from '@admin/services/customerBillingInfoService'
import { reactive, ref } from 'vue'

export const useCustomerBillingInfo = () => {
    const loading = ref(false)
    const formKey = ref(0)
    const route = useRoute()
    const customerId = route.params.id

    const initialValues = reactive({
        name: null,
        country: null,
        postcode: null,
        city: null,
        address: null,
        company_name: null,
        tax_number: null,
        eu_vat_number: null,
    })

    const getCustomerBillingInfo = async params => {
        loading.value = true

        try {
            const { data } = await fetchCustomerBillingInfo(customerId, { ...params })
            initialValues.name = data.name ? data.name : null
            initialValues.country = data.country ? data.country : null
            initialValues.postcode = data.postcode ? data.postcode : null
            initialValues.city = data.city ? data.city : null
            initialValues.address = data.address ? data.address : null
            initialValues.company_name = data.company_name ? data.company_name : null
            initialValues.tax_number = data.tax_number ? data.tax_number : null
            initialValues.eu_vat_number = data.eu_vat_number ? data.eu_vat_number : null
            formKey.value++ // to remount primevue/form to trigger form resolver/validation https://github.com/primefaces/primevue/issues/7792
            loading.value = false
        } catch (e) {
            loading.value = false
            void e // to avoid unused variable lint error
            // console.error(e) -- IGNORE --
        } finally {
            formKey.value++
            loading.value = false
        }
    }

    return {
        loading,
        getCustomerBillingInfo,
        initialValues,
        formKey,
        customerId,
    }
}
