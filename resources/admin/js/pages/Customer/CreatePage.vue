<template>
    <AppLayout>
        <PageTitle title="Add new Client">
            <template #actions>
                <Button icon="pi pi-angle-left" label="Back to list" primary @click="toUsersList" />
            </template>
        </PageTitle>
        <div class="card">
            <Form
                v-slot="$form"
                :initial-values="initialValues"
                :resolver="customerValidator"
                class="flex flex-col gap-4 w-full"
                :validate-on-value-update="true"
                :validate-on-blur="true"
                @submit="onFormSubmit"
            >
                <div class="flex flex-col gap-1 w-full lg:w-1/2">
                    <label for="name">Name</label>
                    <InputText id="name" name="name" type="text" placeholder="Simon Baker" fluid />
                    <Message
                        v-if="$form.name?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.name.error?.message }}</Message
                    >
                </div>
                <div class="flex flex-col gap-1 w-full lg:w-1/2">
                    <label for="email">Email address</label>
                    <InputText
                        id="email"
                        name="email"
                        type="email"
                        placeholder="simon.baker@example.com"
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
import { Button, InputText, Message, ToggleSwitch } from 'primevue'
import { useCustomToast } from '@admin/composables/useCustomToast'
import { useCustomer } from '@admin/composables/useCustomer.js'
import { useRedirects } from '@admin/composables/useRedirects.js'
import { Form } from '@primevue/forms'
import { createCustomer } from '@admin/services/customerService'
import { customerValidator } from '@admin/validators/customerValidator'

const { toCustomersList } = useRedirects()
const { customToast } = useCustomToast()
const { initialValues } = useCustomer()

const onFormSubmit = async ({ valid, values }) => {
    if (valid) {
        try {
            await createCustomer(values)

            customToast.success('Client created successfully!')

            toCustomersList()
        } catch (error) {
            const msg = error?.response?.data?.message
            customToast.error(msg || 'Please try again.')
        }
    } else {
        customToast.error(`${Object.keys(errors).length} field contains errors`)
    }
}
</script>
