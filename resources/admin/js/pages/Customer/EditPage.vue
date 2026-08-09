<template>
    <AppLayout>
        <PageTitle title="Edit Customer">
            <template #actions>
                <Button
                    icon="pi pi-refresh"
                    severity="info"
                    label="Send Reset Password"
                    @click="doSendPasswordReset(customerId)"
                />
            </template>
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
                <div class="font-semibold text-xl">Customer Details</div>
                <div class="text-muted-color">Update name, phone number, and email address</div>
            </div>
            <Form
                v-slot="$form"
                :initial-values="initialValues"
                :resolver="customerValidator"
                class="flex flex-col gap-4 w-full"
                :validate-on-value-update="true"
                :validate-on-blur="true"
                :validate-on-mount="true"
                @submit="onFormSubmit"
            >
                <div class="flex flex-col gap-1 w-full lg:w-1/2">
                    <label for="firstName">First Name</label>
                    <InputText
                        id="firstName"
                        name="firstName"
                        type="text"
                        placeholder="Simon"
                        fluid
                    />
                    <Message
                        v-if="$form.firstName?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.firstName.error?.message }}</Message
                    >
                </div>
                <div class="flex flex-col gap-1 w-full lg:w-1/2">
                    <label for="lastName">Last Name</label>
                    <InputText
                        id="lastName"
                        name="lastName"
                        type="text"
                        placeholder="Baker"
                        fluid
                    />
                    <Message
                        v-if="$form.lastName?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.lastName.error?.message }}</Message
                    >
                </div>
                <div class="flex flex-col gap-1 w-full lg:w-1/2">
                    <label for="email">Email</label>
                    <InputText
                        id="email"
                        name="email"
                        type="email"
                        placeholder="tothbela@example.com"
                        fluid
                    />
                    <Message
                        v-if="$form.email?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.email.error?.message }}</Message
                    >
                </div>
                <div class="flex flex-col gap-1 w-full lg:w-1/2">
                    <label for="phone">Phone</label>
                    <InputText
                        id="phone"
                        name="phone"
                        type="text"
                        placeholder="06 123 456 789"
                        fluid
                    />
                    <Message
                        v-if="$form.phone?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.phone.error?.message }}</Message
                    >
                </div>
                <div class="flex flex-col gap-1">
                    <label for="active">Is active</label>
                    <ToggleSwitch name="active" />
                </div>
                <div class="flex flex-col">
                    <Button
                        type="submit"
                        severity="primary"
                        label="Save"
                        class="ml-auto"
                        size="large"
                        style="width: 150px"
                    />
                </div>
            </Form>
        </div>
    </AppLayout>
</template>
<script setup>
import AppLayout from '@admin/layouts/AppLayout.vue'
import PageTitle from '@admin/components/PageTitle.vue'
import { Button, InputText, Menubar, Message, ToggleSwitch } from 'primevue'
import { useCustomToast } from '@admin/composables/useCustomToast'
import { useCustomer } from '@admin/composables/useCustomer.js'
import { useRedirects } from '@admin/composables/useRedirects.js'
import { Form } from '@primevue/forms'
import { updateCustomerById } from '@admin/services/customerService'
import { customerValidator } from '@admin/validators/customerValidator'
import { onMounted, ref } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const { toCustomersList } = useRedirects()
const { customToast } = useCustomToast()
const { initialValues, customerId, formKey, getCustomer, doSendPasswordReset } = useCustomer()
const customerMenu = ref([
    {
        label: 'Customer Details',
        route: '/customers/:id',
        command: () => router.push(`/customers/${customerId}`),
    },
    {
        label: 'Billing Information',
        route: '/customers/:id/billing',
        command: () => router.push(`/customers/${customerId}/billing`),
    },
])
const onFormSubmit = async ({ valid, values }) => {
    if (valid) {
        try {
            await updateCustomerById(customerId, values)

            customToast.success('Customer updated successfully!')

            toCustomersList()
        } catch (error) {
            const msg = error?.response?.data?.message
            customToast.error(msg || 'Please try again.')
        }
    } else {
        customToast.error(`${Object.keys(errors).length} field contains errors`)
    }
}

onMounted(async () => {
    await getCustomer()
})
</script>
