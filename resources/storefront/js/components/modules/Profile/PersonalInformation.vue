<template>
    <section class="rounded-xl border border-surface-200 bg-white p-6">
        <h2 class="text-2xl font-semibold text-surface-900">Personal Information</h2>

        <p class="mt-1 text-sm text-surface-500">
            Please provide the driver's personal information.
        </p>

        <div class="mt-8 grid grid-cols-1 gap-6 md:grid-cols-2">
            <!-- First name -->
            <div>
                <label for="firstName" class="mb-2 block text-sm font-medium">
                    First name <span class="text-red-500">*</span>
                </label>

                <InputText
                    id="firstName"
                    v-model="form.firstName"
                    class="w-full"
                    placeholder="Enter first name"
                />
            </div>

            <!-- Last name -->
            <div>
                <label for="lastName" class="mb-2 block text-sm font-medium">
                    Last name <span class="text-red-500">*</span>
                </label>

                <InputText
                    id="lastName"
                    v-model="form.lastName"
                    class="w-full"
                    placeholder="Enter last name"
                />
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="mb-2 block text-sm font-medium">
                    Email address <span class="text-red-500">*</span>
                </label>

                <InputText
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="w-full"
                    placeholder="Enter email address"
                />
            </div>

            <!-- Phone -->
            <div>
                <label for="phone" class="mb-2 block text-sm font-medium">
                    Phone number <span class="text-red-500">*</span>
                </label>

                <InputText
                    id="phone"
                    v-model="form.phone"
                    type="email"
                    class="w-full"
                    placeholder="+36 30 123 4567"
                />
            </div>

            <!-- Date of birth -->
            <div>
                <label for="birthDate" class="mb-2 block text-sm font-medium">
                    Date of birth <span class="text-red-500">*</span>
                </label>

                <DatePicker
                    id="birthDate"
                    v-model="form.birthDate"
                    class="w-full"
                    show-icon
                    date-format="yy. mm. dd."
                    placeholder="YYYY. MM. DD."
                    :max-date="maxBirthDate"
                    :manual-input="false"
                />
            </div>
        </div>
        <Message severity="info" icon="pi pi-info-circle" class="mt-6">
            Minimum driver age is 25 years.
        </Message>
    </section>
</template>

<script setup>
import { DatePicker, InputText, Message } from 'primevue'
import { useBooking } from '@storefront/composables/useBooking'
import { reactive } from 'vue'

const { maxBirthDate } = useBooking()
const form = reactive({
    firstName: '',
    lastName: '',
    email: '',
    phone: '',
    birthDate: null,
})
</script>
