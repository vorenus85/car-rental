<template>
    <AppLayout>
        <PageTitle title="Edit Customer Billing Info">
            <template #back
                ><Button
                    icon="pi pi-angle-left"
                    severity="secondary"
                    outlined
                    link
                    size="large"
                    @click="toCustomersList"
            /></template>
            <template #menu><Menubar :model="customerMenu" /></template>
        </PageTitle>
        <div v-if="formKey" class="card">
            <div class="mb-4">
                <div class="font-semibold text-xl">Billing Information</div>
                <div class="text-muted-color">Update billing and invoicing information</div>
            </div>
            <Form
                v-slot="$form"
                :initial-values="initialValues"
                :resolver="customerBillingInfoValidator"
                class="flex flex-col gap-4 w-full"
                :validate-on-value-update="true"
                :validate-on-blur="true"
                :validate-on-mount="true"
                @submit="onFormSubmit"
            >
                <div class="flex flex-col gap-1 w-full lg:w-1/2">
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
                <div class="flex flex-col gap-1 w-1/2 lg:w-1/4">
                    <label for="country">Country</label>
                    <Select
                        id="country"
                        v-model="initialValues.country"
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
                <div class="flex flex-col gap-1 w-1/2 lg:w-1/4">
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
                <div class="flex flex-col gap-1 w-1/2 lg:w-1/4">
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
                <div class="flex flex-col gap-1 w-1/2 lg:w-1/4">
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
                <div class="flex flex-col gap-1 w-1/2 lg:w-1/4">
                    <label for="company_name"
                        >Company Name <small class="text-muted-color">(Optional)</small></label
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
                <div class="flex flex-col gap-1 w-1/2 lg:w-1/4">
                    <label for="tax_number"
                        >Tax Number <small class="text-muted-color">(Optional)</small></label
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
                <div class="flex flex-col gap-1 w-1/2 lg:w-1/4">
                    <label for="eu_vat_number"
                        >EU VAT Number <small class="text-muted-color">(Optional)</small></label
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
                <div class="flex flex-col">
                    <Button
                        type="submit"
                        severity="primary"
                        label="Save"
                        class="ml-auto"
                        size="large"
                        style="width: 150px"
                    /></div
            ></Form>
        </div>
    </AppLayout>
</template>
<script setup>
import AppLayout from '@admin/layouts/AppLayout.vue'
import PageTitle from '@admin/components/PageTitle.vue'
import { countryOptions, getCountryName } from '@admin/utils.js'
import { Button, InputText, Menubar, Message, Select } from 'primevue'
import { useCustomer } from '@admin/composables/useCustomer.js'
import { useCustomToast } from '@admin/composables/useCustomToast'
import { useCustomerBillingInfo } from '@admin/composables/useCustomerBillingInfo.js'
import { useRedirects } from '@admin/composables/useRedirects.js'
import { customerBillingInfoValidator } from '@admin/validators/customerBillingInfoValidator.js'
import { updateCustomerBillingInfoById } from '@admin/services/customerBillingInfoService.js'
import { Form } from '@primevue/forms'
import { onMounted } from 'vue'

const { toCustomersList } = useRedirects()
const { customerMenu } = useCustomer()
const { customToast } = useCustomToast()
const { formKey, customerId, getCustomerBillingInfo, initialValues } = useCustomerBillingInfo()

const onFormSubmit = async ({ valid, values }) => {
    if (valid) {
        try {
            await updateCustomerBillingInfoById(customerId, values)

            customToast.success('Customer billing info updated successfully!')

            toCustomersList()
        } catch (error) {
            const msg = error?.response?.data?.message
            customToast.error(msg || 'Please try again.')
        }
    } else {
        customToast.error(`${Object.keys(errors).length} field contains errors`)
    }
}

onMounted(() => {
    getCustomerBillingInfo()
})
</script>
<style>
@import 'flag-icons/css/flag-icons.min.css';
</style>
