<template>
    <PublicLayout class="profile-billing-info-page">
        <div class="mx-auto max-w-8xl px-4 py-4 min-h-[500px]">
            <BreadcrumbModule :items="breadcrumbItems"></BreadcrumbModule>
            <PageTitle title="Billing Info"></PageTitle>
            <div class="mb-10">
                <p class="mt-2 text-sm text-slate-500">Update billing and invoicing information.</p>
            </div>
            <div
                class="flex flex-col gap-6 md:gap-8 items-center justify-center text-center mt-5 mb-5"
            >
                <div v-if="isReady" class="w-full">
                    <Form
                        ref="formRef"
                        v-slot="$form"
                        :initial-values="initialValues"
                        :resolver="billingInfoValidator"
                        class="flex flex-col gap-4 w-full"
                        :validate-on-value-update="true"
                        :validate-on-blur="true"
                        :validate-on-mount="true"
                        @submit="onFormSubmit"
                    >
                        <div class="flex flex-col gap-1 text-left">
                            <label for="name">Name</label>
                            <InputText
                                id="name"
                                name="name"
                                type="text"
                                placeholder="Simon Parker's company"
                                fluid
                            />
                            <Message
                                v-if="$form.name?.invalid"
                                severity="error"
                                size="small"
                                variant="simple"
                                >{{ $form.name.error?.message }}</Message
                            >
                        </div>
                        <div class="flex flex-col gap-1 text-left">
                            <label for="country">Country</label>
                            <Select
                                id="country"
                                name="country"
                                :options="countryOptions"
                                option-label="name"
                                option-value="code"
                                filter
                                class="w-full"
                                placeholder="Select issuing country"
                            >
                                <template #option="{ option }">
                                    <div class="flex items-center gap-3">
                                        <span
                                            :class="`fi fi-${option.code.toLowerCase()}`"
                                            style="border-radius: 2px"
                                        />
                                        {{ option.name }}
                                    </div>
                                </template>

                                <template #value="{ value }">
                                    <div v-if="value" class="flex items-center gap-3">
                                        <span :class="`fi fi-${value.toLowerCase()}`" />
                                        {{ getCountryName(value) }}
                                    </div>

                                    <span v-else>Select country</span>
                                </template>
                            </Select>
                            <Message
                                v-if="$form.country?.invalid"
                                severity="error"
                                size="small"
                                variant="simple"
                                >{{ $form.country.error?.message }}</Message
                            >
                        </div>
                        <div class="flex flex-col gap-1 text-left">
                            <label for="postcode">Postcode</label>
                            <InputText
                                id="postcode"
                                name="postcode"
                                type="text"
                                placeholder="Postcode"
                                fluid
                            />
                            <Message
                                v-if="$form.postcode?.invalid"
                                severity="error"
                                size="small"
                                variant="simple"
                                >{{ $form.postcode.error?.message }}</Message
                            >
                        </div>
                        <div class="flex flex-col gap-1 text-left">
                            <label for="city">City</label>
                            <InputText id="city" name="city" type="text" placeholder="City" fluid />
                            <Message
                                v-if="$form.city?.invalid"
                                severity="error"
                                size="small"
                                variant="simple"
                                >{{ $form.city.error?.message }}</Message
                            >
                        </div>
                        <div class="flex flex-col gap-1 text-left">
                            <label for="address">Address</label>
                            <InputText
                                id="address"
                                name="address"
                                type="text"
                                placeholder="Address"
                                fluid
                            />
                            <Message
                                v-if="$form.address?.invalid"
                                severity="error"
                                size="small"
                                variant="simple"
                                >{{ $form.address.error?.message }}</Message
                            >
                        </div>
                        <div class="flex flex-col gap-1 text-left">
                            <label for="company_name"
                                >Company Name
                                <small class="text-muted-color">(Optional)</small></label
                            >
                            <InputText
                                id="company_name"
                                name="company_name"
                                type="text"
                                placeholder="Company Name"
                                fluid
                            />
                            <Message
                                v-if="$form.company_name?.invalid"
                                severity="error"
                                size="small"
                                variant="simple"
                                >{{ $form.company_name.error?.message }}</Message
                            >
                        </div>
                        <div class="flex flex-col gap-1 text-left">
                            <label for="tax_number"
                                >Tax Number
                                <small class="text-muted-color">(Optional)</small></label
                            >
                            <InputText
                                id="tax_number"
                                name="tax_number"
                                type="text"
                                placeholder="Tax Number"
                                fluid
                            />
                            <Message
                                v-if="$form.tax_number?.invalid"
                                severity="error"
                                size="small"
                                variant="simple"
                                >{{ $form.tax_number.error?.message }}</Message
                            >
                        </div>
                        <div class="flex flex-col gap-1 text-left">
                            <label for="eu_vat_number"
                                >EU VAT Number
                                <small class="text-muted-color">(Optional)</small></label
                            >
                            <InputText
                                id="eu_vat_number"
                                name="eu_vat_number"
                                type="text"
                                placeholder="EU VAT Number"
                                fluid
                            />
                            <Message
                                v-if="$form.eu_vat_number?.invalid"
                                severity="error"
                                size="small"
                                variant="simple"
                                >{{ $form.eu_vat_number.error?.message }}</Message
                            >
                        </div>
                        <div class="flex flex-col text-left">
                            <Button
                                type="submit"
                                severity="primary"
                                label="Save"
                                class="mt-4 w-32"
                            />
                        </div>
                    </Form>
                </div>
                <div v-else class="w-full text-center text-muted-color">
                    Loading billing details...
                </div>
            </div>
        </div>
    </PublicLayout>
</template>
<script setup>
import PublicLayout from '@storefront/layouts/PublicLayout.vue'
import PageTitle from '@storefront/components/modules/PageTitle.vue'
import BreadcrumbModule from '@storefront/components/modules/BreadcrumbModule.vue'
import { useAuthStore } from '@storefront/stores/authStore'
import { useCustomToast } from '@storefront/composables/useCustomToast'
import { editBillingInfo } from '@storefront/services/authService'
import { billingInfoValidator } from '@storefront/validators/billingInfoValidator.js'
import { countryOptions, getCountryName } from '@storefront/utils.js'
import { Button, InputText, Message, Select } from 'primevue'
import { Form } from '@primevue/forms'
import { computed, onMounted, ref } from 'vue'

const authStore = useAuthStore()
const { customToast } = useCustomToast()
const formRef = ref(null)
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
<style>
@import 'flag-icons/css/flag-icons.min.css';
</style>
