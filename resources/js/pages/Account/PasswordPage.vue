<template>
    <AppLayout>
        <PageTitle title="Account">
            <template #actions>
                <Menubar class="mb-4" :model="accountMenu" />
            </template>
        </PageTitle>
        <div class="card">
            <div class="mb-4">
                <div class="font-semibold text-xl">Update password</div>
                <div class="text-muted-color">
                    Ensure your account is using a long, random password to stay secure
                </div>
            </div>
            <Form
                ref="formRef"
                v-slot="$form"
                :resolver="changePasswordValidator"
                class="flex flex-col gap-4 w-full"
                :validate-on-value-update="true"
                :validate-on-blur="true"
                @submit="onFormSubmit"
            >
                <div class="flex flex-col gap-1 w-full lg:w-1/2">
                    <label for="current_password">Current password</label>
                    <Password
                        input-id="current_password"
                        name="current_password"
                        type="text"
                        placeholder="Current password"
                        :feedback="false"
                        min="8"
                        toggle-mask
                        fluid
                    />
                    <Message
                        v-if="$form.current_password?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.current_password.error?.message }}</Message
                    >
                </div>
                <div class="flex flex-col gap-1 w-full lg:w-1/2">
                    <label for="password">Password</label>
                    <Password
                        input-id="password"
                        name="password"
                        type="text"
                        placeholder="Password"
                        :value="password"
                        prompt-label="Choose a password"
                        weak-label="Too simple"
                        medium-label="Average complexity"
                        strong-label="Complex password"
                        min="8"
                        toggle-mask
                        fluid
                    />
                    <Message
                        v-if="$form.password?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.password.error?.message }}</Message
                    >
                </div>
                <div class="flex flex-col gap-1 w-full lg:w-1/2">
                    <label for="password_confirmation">Confirm password</label>
                    <Password
                        input-id="password_confirmation"
                        name="password_confirmation"
                        type="text"
                        :value="password_confirmation"
                        placeholder="Confirm password"
                        prompt-label="Choose a password"
                        weak-label="Too simple"
                        medium-label="Average complexity"
                        strong-label="Complex password"
                        min="8"
                        toggle-mask
                        fluid
                    />
                    <Message
                        v-if="$form.password_confirmation?.invalid"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ $form.password_confirmation.error?.message }}</Message
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
        </div>
    </AppLayout>
</template>
<script setup>
import AppLayout from '@/layouts/AppLayout.vue'
import PageTitle from '@/components/PageTitle.vue'
import { Button, Menubar, Message, Password } from 'primevue'
import { Form } from '@primevue/forms'
import { useAccount } from '@/composables/useAccount'
import { useCustomToast } from '@/composables/useCustomToast'
import { updatePassword } from '@/services/accountService'
import { ref } from 'vue'

const { accountMenu, changePasswordValidator, password, password_confirmation } = useAccount()
const { customToast } = useCustomToast()
const formRef = ref(null)

const onFormSubmit = async ({ valid, values, errors }) => {
    console.log(errors)
    if (valid) {
        try {
            await updatePassword(values)
            formRef.value.reset()
            customToast.success('Password updated successfully!')
        } catch (error) {
            console.log(error)
            const msg = error?.response?.data?.message
            customToast.error(msg || 'Please try again.')
        }
    }
}
</script>
