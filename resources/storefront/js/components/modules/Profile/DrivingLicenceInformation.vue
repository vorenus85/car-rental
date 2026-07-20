<template>
    <section class="">
        <Form
            v-slot="$form"
            class="flex flex-col gap-4 w-full"
            :resolver="drivingLicenceValidator"
            @submit="onFormSubmit"
        >
            <div class="mt-8 grid grid-cols-1 gap-6 md:grid-cols-2">
                <!-- Driving licence number -->
                <div>
                    <label for="licenceNumber" class="mb-2 block text-sm font-medium">
                        Driving licence number
                        <span class="text-red-500">*</span>
                    </label>

                    <InputText
                        id="licenceNumber"
                        v-model="form.licenceNumber"
                        name="licenceNumber"
                        class="w-full"
                        placeholder="Enter driving licence number"
                    />
                    <Message
                        v-if="$form.licenceNumber?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.licenceNumber.error?.message }}</Message
                    >
                </div>

                <!-- Issuing country -->
                <div>
                    <label for="issuingCountry" class="mb-2 block text-sm font-medium">
                        Issuing country
                        <span class="text-red-500">*</span>
                    </label>

                    <Select
                        id="issuingCountry"
                        v-model="form.issuingCountry"
                        name="issuingCountry"
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
                        v-if="$form.issuingCountry?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.issuingCountry.error?.message }}</Message
                    >
                </div>

                <!-- Issue date -->
                <div>
                    <label for="issueDate" class="mb-2 block text-sm font-medium">
                        Licence issue date
                        <span class="text-red-500">*</span>
                    </label>

                    <DatePicker
                        id="issueDate"
                        v-model="form.issueDate"
                        name="issueDate"
                        class="w-full"
                        show-icon
                        date-format="yy-mm-dd"
                        placeholder="YYYY-MM-DD"
                        :manual-input="false"
                        :max-date="maxLicenceDate"
                    />
                    <Message
                        v-if="$form.issueDate?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.issueDate.error?.message }}</Message
                    >
                </div>

                <!-- Expiry date -->
                <div>
                    <label for="expiryDate" class="mb-2 block text-sm font-medium">
                        Licence expiry date
                        <span class="text-red-500">*</span>
                    </label>

                    <DatePicker
                        id="expiryDate"
                        v-model="form.expiryDate"
                        name="expiryDate"
                        class="w-full"
                        show-icon
                        date-format="yy-mm-dd"
                        placeholder="YYYY-MM-DD"
                        :manual-input="false"
                        :min-date="new Date()"
                    />
                    <Message
                        v-if="$form.expiryDate?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.expiryDate.error?.message }}</Message
                    >
                </div>
            </div>

            <Message severity="info" icon="pi pi-info-circle" class="mt-6">
                The driver must have held a valid driving licence for at least two year.
            </Message>
            <div class="md:col-span-2 flex justify-between mt-5">
                <Button
                    v-if="showBack"
                    :label="backLabel"
                    icon="pi pi-arrow-left"
                    text
                    severity="secondary"
                    @click="$emit('back', section)"
                />
                <Button
                    :label="btnLabel"
                    size="large"
                    icon="pi pi-arrow-right"
                    icon-pos="right"
                    class="min-w-52"
                    type="submit"
                />
            </div>
        </Form>
    </section>
</template>

<script setup>
import { Button, DatePicker, InputText, Message, Select } from 'primevue'
import { countryOptions, getCountryName } from '@storefront/utils.js'
import { drivingLicenceValidator } from '@storefront/validators/drivingLicenceValidator'
import { useBooking } from '@storefront/composables/useBooking'
import { reactive } from 'vue'
import { Form } from '@primevue/forms'

const emit = defineEmits(['save', 'back'])

const props = defineProps({
    btnLabel: {
        type: String,
        default: 'Save',
    },
    backLabel: {
        type: String,
        default: 'Back',
    },
    showBack: {
        type: Boolean,
        default: false,
    },
    section: {
        type: String,
        default: 'default',
    },
})

const { maxLicenceDate } = useBooking()

const form = reactive({
    licenceNumber: '',
    issuingCountry: null,
    issueDate: null,
    expiryDate: null,
})

const onFormSubmit = ({ valid, values, errors }) => {
    emit('save', {
        section: props.section,
        valid,
        values,
        errors,
    })
}
</script>
