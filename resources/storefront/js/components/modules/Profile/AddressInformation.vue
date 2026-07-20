<template>
    <section class="">
        <Form
            v-slot="$form"
            class="flex flex-col gap-4 w-full"
            :resolver="addressValidator"
            @submit="onFormSubmit"
        >
            <div class="mt-8 grid grid-cols-1 gap-6 md:grid-cols-2">
                <!-- Country -->
                <div>
                    <label for="country" class="mb-2 block text-sm font-medium">
                        Country <span class="text-red-500">*</span>
                    </label>

                    <Select
                        id="country"
                        name="country"
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
                    <Message
                        v-if="$form.country?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.country.error?.message }}</Message
                    >
                </div>

                <!-- City -->
                <div>
                    <label for="city" class="mb-2 block text-sm font-medium">
                        City <span class="text-red-500">*</span>
                    </label>

                    <InputText
                        id="city"
                        v-model="form.city"
                        name="city"
                        class="w-full"
                        placeholder="Enter city"
                    />
                    <Message
                        v-if="$form.city?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.city.error?.message }}</Message
                    >
                </div>

                <!-- Postal code -->
                <div>
                    <label for="postalCode" class="mb-2 block text-sm font-medium">
                        Postal code <span class="text-red-500">*</span>
                    </label>

                    <InputText
                        id="postalCode"
                        v-model="form.postalCode"
                        name="postalCode"
                        class="w-full"
                        placeholder="Enter postal code"
                    />
                    <Message
                        v-if="$form.postalCode?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.postalCode.error?.message }}</Message
                    >
                </div>

                <!-- Address line 1 -->
                <div>
                    <label for="addressLine1" class="mb-2 block text-sm font-medium">
                        Address line 1 <span class="text-red-500">*</span>
                    </label>

                    <InputText
                        id="addressLine1"
                        v-model="form.addressLine1"
                        name="addressLine1"
                        class="w-full"
                        placeholder="Street name, house number"
                    />
                    <Message
                        v-if="$form.addressLine1?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.addressLine1.error?.message }}</Message
                    >
                </div>

                <!-- Address line 2 -->
                <div class="md:col-span-2">
                    <label for="addressLine2" class="mb-2 block text-sm font-medium">
                        Address line 2
                        <span class="text-surface-400">(optional)</span>
                    </label>

                    <InputText
                        id="addressLine2"
                        v-model="form.addressLine2"
                        name="addressLine2"
                        class="w-full"
                        placeholder="Apartment, suite, unit, etc."
                    />
                </div>
            </div>
            <div class="md:col-span-2 flex justify-between mt-5">
                <Button
                    v-if="showBack"
                    :label="backLabel"
                    icon="pi pi-arrow-left"
                    text
                    severity="secondary"
                    @click="$emit('back', section)"
                />

                <Button :label="btnLabel" class="min-w-35" type="submit" />
            </div>
        </Form>
    </section>
</template>

<script setup>
import { Button, InputText, Select, Message } from 'primevue'
import { countryOptions, getCountryName } from '@storefront/utils.js'
import { addressValidator } from '@storefront/validators/addressValidator'
import { onMounted, reactive } from 'vue'
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

const form = reactive({
    country: null,
    city: '',
    postalCode: '',
    addressLine1: '',
    addressLine2: '',
})

const onFormSubmit = ({ valid, values, errors }) => {
    emit('save', {
        section: props.section,
        valid,
        values,
        errors,
    })
}

onMounted(() => {})
</script>
<style>
@import 'flag-icons/css/flag-icons.min.css';
</style>
