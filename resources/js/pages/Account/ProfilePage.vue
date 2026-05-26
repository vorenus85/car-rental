<template>
    <AppLayout>
        <PageTitle title="Account">
            <template #actions>
                <Menubar class="mb-4" :model="accountMenu" />
            </template>
        </PageTitle>
        <div class="card">
            <div class="mb-4">
                <div class="font-semibold text-xl">Profile information</div>
                <div class="text-muted-color">Update your name and email address</div>
            </div>
            <template v-if="formKey">
                <Form
                    v-slot="$form"
                    :initial-values="initialValues"
                    :resolver="profileValidator"
                    class="flex flex-col gap-4 w-full"
                    :validate-on-value-update="true"
                    :validate-on-blur="true"
                    :validate-on-mount="true"
                    @submit="onFormSubmit"
                >
                    <div class="flex flex-col gap-1 w-full lg:w-1/2">
                        <label for="name">Name</label>
                        <InputText
                            id="name"
                            name="name"
                            type="text"
                            placeholder="Tóth Béla"
                            fluid
                        />
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
            </template>
        </div>
    </AppLayout>
</template>
<script setup>
import AppLayout from '@/layouts/AppLayout.vue'
import PageTitle from '@/components/PageTitle.vue'
import { Button, InputText, Menubar, Message } from 'primevue'
import { Form } from '@primevue/forms'
import { onMounted } from 'vue'
import { useAccount } from '@/composables/useAccount'
import { updateMe } from '@/services/accountService'
import { useCustomToast } from '@/composables/useCustomToast'

const { customToast } = useCustomToast()
const { accountMenu, profileValidator, getProfile, initialValues, formKey } = useAccount()

const onFormSubmit = async ({ valid, values }) => {
    if (valid) {
        try {
            await updateMe(values)

            customToast.success('Profile updated successfully!')
        } catch (error) {
            const msg = error?.response?.data?.message
            customToast.error(msg || 'Please try again.')
        }
    }
}

onMounted(async () => {
    await getProfile()
})
</script>
