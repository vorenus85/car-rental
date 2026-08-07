<template>
    <section class="">
        <Form
            v-slot="$form"
            :initial-values="initialValues"
            class="flex flex-col gap-4 w-full"
            :resolver="personalValidator"
            @submit="onFormSubmit"
        >
            <div class="mt-8 grid grid-cols-1 gap-6 md:grid-cols-2">
                <!-- First name -->
                <div>
                    <label for="firstName" class="mb-2 block text-sm font-medium">
                        First name <span class="text-red-500">*</span>
                    </label>

                    <InputText
                        id="firstName"
                        name="firstName"
                        class="w-full"
                        placeholder="Enter first name"
                    />
                    <Message
                        v-if="$form.firstName?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.firstName.error?.message }}</Message
                    >
                </div>

                <!-- Last name -->
                <div>
                    <label for="lastName" class="mb-2 block text-sm font-medium">
                        Last name <span class="text-red-500">*</span>
                    </label>

                    <InputText
                        id="lastName"
                        name="lastName"
                        class="w-full"
                        placeholder="Enter last name"
                    />
                    <Message
                        v-if="$form.lastName?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.lastName.error?.message }}</Message
                    >
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="mb-2 block text-sm font-medium">
                        Email address <span class="text-red-500">*</span>
                    </label>

                    <InputText
                        id="email"
                        name="email"
                        type="email"
                        class="w-full"
                        placeholder="Enter email address"
                    />
                    <Message
                        v-if="$form.email?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.email.error?.message }}</Message
                    >
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone" class="mb-2 block text-sm font-medium">
                        Phone number <span class="text-red-500">*</span>
                    </label>

                    <InputText
                        id="phone"
                        name="phone"
                        type="text"
                        class="w-full"
                        placeholder="+36 30 123 4567"
                    />
                    <Message
                        v-if="$form.phone?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.phone.error?.message }}</Message
                    >
                </div>

                <!-- Date of birth -->
                <div>
                    <label for="birthDate" class="mb-2 block text-sm font-medium">
                        Date of birth <span class="text-red-500">*</span>
                    </label>

                    <DatePicker
                        id="birthDate"
                        v-model="initialValues.birthDate"
                        name="birthDate"
                        class="w-full"
                        show-icon
                        date-format="yy. mm. dd."
                        placeholder="YYYY. MM. DD."
                        :max-date="maxBirthDate"
                        :manual-input="false"
                    />
                    <Message
                        v-if="$form.birthDate?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.birthDate.error?.message }}</Message
                    >
                </div>
            </div>
            <Message severity="info" icon="pi pi-info-circle" class="mt-6">
                Minimum driver age is 25 years.
            </Message>
            <div class="md:col-span-2 flex justify-end mt-5">
                <Button :label="btnLabel" class="min-w-35" type="submit" />
            </div>
        </Form>
    </section>
</template>

<script setup>
import { Form } from '@primevue/forms'
import { Button, DatePicker, InputText, Message } from 'primevue'
import { useBooking } from '@storefront/composables/useBooking'
import { personalValidator } from '@storefront/validators/personalValidator'
import { useBookingStore } from '@storefront/stores/bookingStore'

const emit = defineEmits(['save'])
const bookingStore = useBookingStore()
const props = defineProps({
    btnLabel: {
        type: String,
        default: 'Save',
    },
    section: {
        type: String,
        default: 'default',
    },
})

const { maxBirthDate } = useBooking()

const initialValues = {
    firstName: bookingStore.driver.personal.firstName,
    lastName: bookingStore.driver.personal.lastName,
    email: bookingStore.driver.personal.email,
    phone: bookingStore.driver.personal.phone,
    birthDate: new Date(bookingStore.driver.personal.birthDate ?? '1990-01-01'),
}

const onFormSubmit = ({ valid, values, errors }) => {
    emit('save', {
        section: props.section,
        valid,
        values,
        errors,
    })
}
</script>
