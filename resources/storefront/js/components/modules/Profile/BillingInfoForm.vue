<template>
    <Form
        v-slot="$form"
        :initial-values="initialValues"
        :resolver="resolver"
        class="flex flex-col gap-4 w-full"
        :validate-on-value-update="true"
        :validate-on-blur="true"
        :validate-on-mount="true"
        @submit="$emit('submit', $event)"
    >
        <div class="rounded-2xl border border-surface-200 bg-white p-5 md:p-6 space-y-5">
            <div class="space-y-1">
                <h3 class="text-lg font-semibold text-surface-900">Billing address</h3>
                <p class="text-sm text-surface-500">
                    Add the main address details that should appear on the invoice.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
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
                    >
                        {{ $form.name.error?.message }}
                    </Message>
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
                    >
                        {{ $form.country.error?.message }}
                    </Message>
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
                    >
                        {{ $form.postcode.error?.message }}
                    </Message>
                </div>

                <div class="flex flex-col gap-1 text-left">
                    <label for="city">City</label>
                    <InputText id="city" name="city" type="text" placeholder="City" fluid />
                    <Message
                        v-if="$form.city?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                    >
                        {{ $form.city.error?.message }}
                    </Message>
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
                    >
                        {{ $form.address.error?.message }}
                    </Message>
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-surface-200 bg-white p-5 md:p-6 space-y-5">
            <div class="space-y-1">
                <h3 class="text-lg font-semibold text-surface-900">Company details</h3>
                <p class="text-sm text-surface-500">
                    Fill in company and tax information when you need invoice data for a business.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="flex flex-col gap-1 text-left">
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

                <div class="flex flex-col gap-1 text-left">
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

                <div class="flex flex-col gap-1 text-left">
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
            </div>
        </div>

        <div class="flex flex-col text-left">
            <Button type="submit" severity="primary" :label="submitLabel" class="mt-4 w-32" />
        </div>
    </Form>
</template>

<script setup>
import { Form } from '@primevue/forms'
import { Button, InputText, Message, Select } from 'primevue'
import { countryOptions, getCountryName } from '@storefront/utils.js'

defineProps({
    initialValues: {
        type: Object,
        required: true,
    },
    resolver: {
        type: Function,
        required: true,
    },
    submitLabel: {
        type: String,
        default: 'Save',
    },
})

defineEmits(['submit'])
</script>

<style>
@import 'flag-icons/css/flag-icons.min.css';
</style>
