<template>
    <section class="rounded-xl border border-surface-200 bg-white p-6">
        <h2 class="text-2xl font-semibold text-surface-900">Address Information</h2>

        <p class="mt-1 text-sm text-surface-500">Please provide your residential address.</p>

        <div class="mt-8 grid grid-cols-1 gap-6 md:grid-cols-2">
            <!-- Country -->
            <div>
                <label for="country" class="mb-2 block text-sm font-medium">
                    Country <span class="text-red-500">*</span>
                </label>

                <Select
                    id="country"
                    v-model="form.country"
                    :options="countryOptions"
                    option-label="name"
                    option-value="code"
                    filter
                    class="w-full"
                    placeholder="Select country"
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

            <!-- City -->
            <div>
                <label for="city" class="mb-2 block text-sm font-medium">
                    City <span class="text-red-500">*</span>
                </label>

                <InputText id="city" v-model="form.city" class="w-full" placeholder="Enter city" />
            </div>

            <!-- Postal code -->
            <div>
                <label for="postalCode" class="mb-2 block text-sm font-medium">
                    Postal code <span class="text-red-500">*</span>
                </label>

                <InputText
                    id="postalCode"
                    v-model="form.postalCode"
                    class="w-full"
                    placeholder="Enter postal code"
                />
            </div>

            <!-- Address line 1 -->
            <div>
                <label for="address1" class="mb-2 block text-sm font-medium">
                    Address line 1 <span class="text-red-500">*</span>
                </label>

                <InputText
                    id="address1"
                    v-model="form.addressLine1"
                    class="w-full"
                    placeholder="Street name, house number"
                />
            </div>

            <!-- Address line 2 -->
            <div class="md:col-span-2">
                <label for="address2" class="mb-2 block text-sm font-medium">
                    Address line 2
                    <span class="text-surface-400">(optional)</span>
                </label>

                <InputText
                    id="address2"
                    v-model="form.addressLine2"
                    class="w-full"
                    placeholder="Apartment, suite, unit, etc."
                />
            </div>
        </div>
    </section>
</template>

<script setup>
import { InputText, Select } from 'primevue'
import { countryOptions, getCountryName } from '@storefront/utils.js'
import { reactive } from 'vue'

const form = reactive({
    country: null,
    city: '',
    postalCode: '',
    addressLine1: '',
    addressLine2: '',
})
</script>
<style>
@import 'flag-icons/css/flag-icons.min.css';
</style>
