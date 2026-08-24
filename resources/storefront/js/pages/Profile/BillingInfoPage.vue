<template>
    <PublicLayout class="profile-billing-info-page">
        <div class="mx-auto max-w-8xl px-4 py-4 min-h-[500px]">
            <BreadcrumbModule :items="breadcrumbItems"></BreadcrumbModule>
            <PageTitle title="Billing Info"></PageTitle>
            <div class="mb-10">
                <p class="mt-2 text-sm text-slate-500">Update billing and invoicing information.</p>
            </div>
            <div class="mt-5 grid grid-cols-1 gap-8 lg:grid-cols-[280px_minmax(0,1fr)] items-start">
                <ProfileSidebar />
                <div class="mb-10">
                    <div v-if="isReady" class="w-full">
                        <BillingInfoForm
                            :initial-values="initialValues"
                            :resolver="billingInfoValidator"
                            @submit="onFormSubmit"
                        />
                    </div>
                    <div v-else class="w-full text-center text-muted-color">
                        Loading billing details...
                    </div>
                </div>
            </div>
        </div>
    </PublicLayout>
</template>
<script setup>
import PublicLayout from '@storefront/layouts/PublicLayout.vue'
import PageTitle from '@storefront/components/modules/PageTitle.vue'
import BreadcrumbModule from '@storefront/components/modules/BreadcrumbModule.vue'
import ProfileSidebar from '@storefront/components/modules/Profile/ProfileSidebar.vue'
import BillingInfoForm from '@storefront/components/modules/Profile/BillingInfoForm.vue'
import { useAuthStore } from '@storefront/stores/authStore'
import { useCustomToast } from '@storefront/composables/useCustomToast'
import { editBillingInfo } from '@storefront/services/authService'
import { billingInfoValidator } from '@storefront/validators/billingInfoValidator.js'
import { computed, onMounted, ref } from 'vue'

const authStore = useAuthStore()
const { customToast } = useCustomToast()
const isReady = ref(false)

const initialValues = computed(() => ({
    name: authStore.user?.billingInfo?.name ?? '',
    country: authStore.user?.billingInfo?.country ?? '',
    postcode: authStore.user?.billingInfo?.postcode ?? '',
    city: authStore.user?.billingInfo?.city ?? '',
    address: authStore.user?.billingInfo?.address ?? '',
    company_name:
        authStore.user?.billingInfo?.companyName ?? authStore.user?.billingInfo?.company_name ?? '',
    tax_number:
        authStore.user?.billingInfo?.taxNumber ?? authStore.user?.billingInfo?.tax_number ?? '',
    eu_vat_number:
        authStore.user?.billingInfo?.euVatNumber ??
        authStore.user?.billingInfo?.eu_vat_number ??
        '',
}))

const breadcrumbItems = [
    {
        label: 'Profile',
        route: '/profile',
    },
    {
        label: 'Billing info',
    },
]

onMounted(async () => {
    await authStore.init()
    isReady.value = true
})

const onFormSubmit = async ({ valid, values, errors }) => {
    if (valid) {
        try {
            const response = await editBillingInfo(values)

            authStore.user.billingInfo = response.data.billingInfo

            customToast.success('Billing info updated successfully.')
        } catch (error) {
            console.error(error)
            const msg = error?.response?.data?.message
            customToast.error(msg || 'Please try again.')
        }
    } else {
        customToast.error(`${Object.keys(errors).length} field contains errors`)
    }
}
</script>
