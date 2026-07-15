<template>
    <section class="rounded-xl border border-surface-200 bg-white p-6">
        <h2 class="text-2xl font-semibold text-surface-900">Driving Licence</h2>

        <p class="mt-1 text-sm text-surface-500">Please provide your driving licence details.</p>

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
                    class="w-full"
                    placeholder="Enter driving licence number"
                />
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
                    class="w-full"
                    show-icon
                    date-format="yy-mm-dd"
                    placeholder="YYYY-MM-DD"
                    :manual-input="false"
                    :max-date="maxLicenceDate"
                />
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
                    class="w-full"
                    show-icon
                    date-format="yy-mm-dd"
                    placeholder="YYYY-MM-DD"
                    :manual-input="false"
                    :min-date="new Date()"
                />
            </div>
        </div>

        <Message severity="info" icon="pi pi-info-circle" class="mt-6">
            The driver must have held a valid driving licence for at least two year.
        </Message>
    </section>
</template>

<script setup>
import { DatePicker, InputText, Message, Select } from 'primevue'
import { countryOptions, getCountryName } from '@storefront/utils.js'
import { useBooking } from '@storefront/composables/useBooking'
import { reactive } from 'vue'

const { maxLicenceDate } = useBooking()

const form = reactive({
    licenceNumber: '',
    issuingCountry: null,
    issueDate: null,
    expiryDate: null,
})
</script>
