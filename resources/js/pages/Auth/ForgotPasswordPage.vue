<template>
    <main>
        <div class="h-screen flex items-center justify-center flex-col">
            <div class="mb-5"><LogoIcon /></div>
            <Card class="p-4 py-6 w-full sm:max-w-lg">
                <template #content>
                    <div
                        class="flex flex-col gap-6 md:gap-8 items-center justify-center text-center"
                    >
                        <div class="text-xl"><strong>Forgot password </strong></div>
                        <div class="text-center">
                            Enter your email address to receive a password reset link
                        </div>
                        <Form
                            v-slot="$form"
                            class="flex flex-col gap-4 w-full"
                            :resolver="forgotPasswordValidator"
                            @submit="onFormSubmit"
                        >
                            <div class="flex flex-col gap-1 text-left">
                                <label for="email">Email address</label>
                                <InputText
                                    id="email"
                                    name="email"
                                    type="email"
                                    placeholder="Email address"
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
                            <Button type="submit" label="Email password reset link" />
                        </Form>
                        <div class="text-center">
                            <span class="text-muted-color mr-1"> Or, return to </span>
                            <RouterLink to="/" class="font-semibold">Log in</RouterLink>
                        </div>
                    </div>
                </template>
            </Card>
        </div>
    </main>
</template>
<script setup>
import LogoIcon from '@/components/LogoIcon.vue'
import { Form } from '@primevue/forms'
import { Button, Card, InputText, Message } from 'primevue'
import { forgotPassword } from '@/services/authService'
import { useCustomToast } from '@/composables/useCustomToast'
import { forgotPasswordValidator } from '@/validators/forgotPasswordValidator'

const { customToast } = useCustomToast()

const onFormSubmit = async ({ valid, values }) => {
    if (valid) {
        try {
            const { data } = await forgotPassword(values.email)
            customToast.success(data?.message)
        } catch (error) {
            const msg = error?.response?.data?.message
            customToast.error(msg || 'Please try again.')
        }
    }
}
</script>
