<template>
    <AppLayout>
        <PageTitle title="Edit User">
            <template #actions>
                <Button icon="pi pi-angle-left" label="Back to list" primary @click="toUsersList" />
            </template>
        </PageTitle>
        <div v-if="formKey" class="card">
            <Form
                v-slot="$form"
                :initial-values="initialValues"
                :resolver="userValidator"
                class="flex flex-col gap-4 w-full"
                :validate-on-value-update="true"
                :validate-on-blur="true"
                :validate-on-mount="true"
                @submit="onFormSubmit"
            >
                <div class="flex flex-col gap-1 w-full lg:w-1/2">
                    <label for="name">Name</label>
                    <InputText id="name" name="name" type="text" placeholder="Tóth Béla" fluid />
                    <Message
                        v-if="$form.name?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.name.error?.message }}</Message
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
import AppLayout from '@/layouts/AppLayout.vue'
import PageTitle from '@/components/PageTitle.vue'
import { Button, InputText, Message, ToggleSwitch } from 'primevue'
import { useCustomToast } from '@/composables/useCustomToast'
import { useUser } from '@/composables/useUser.js'
import { useRedirects } from '@/composables/useRedirects.js'
import { Form } from '@primevue/forms'
import { updateUserById } from '@/services/userService'
import { onMounted } from 'vue'

const { toUsersList } = useRedirects()
const { customToast } = useCustomToast()
const { initialValues, userId, userValidator, formKey, getUser } = useUser()

const onFormSubmit = async ({ valid, values }) => {
    if (valid) {
        try {
            await updateUserById(userId, values)

            customToast.success('User updated successfully!')

            setTimeout(() => {
                toUsersList()
            }, 300)
        } catch (error) {
            const msg = error?.response?.data?.message
            customToast.error(msg || 'Please try again.')
        }
    }
}

onMounted(async () => {
    await getUser()
})
</script>
