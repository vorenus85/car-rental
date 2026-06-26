<template>
    <PublicLayout class="login-page">
        <div class="mx-auto max-w-8xl px-4 py-4 min-h-[500px]">
            <BreadcrumbModule :items="breadcrumbItems"></BreadcrumbModule>
            <div class="flex items-center justify-center flex-col mt-5 mb-5">
                <Card class="p-4 py-6 w-full sm:max-w-lg">
                    <template #content>
                        <div
                            class="flex flex-col gap-6 md:gap-8 items-center justify-center text-center"
                        >
                            <div class="text-xl"><strong>Log in</strong></div>
                            <div class="text-center">
                                Enter your email and password below to log in
                            </div>

                            <Form
                                v-slot="$form"
                                class="flex flex-col gap-4 w-full"
                                :resolver="loginValidator"
                                @submit="onFormSubmit"
                            >
                                <div class="flex flex-col gap-1 text-left">
                                    <label for="email">Email address</label>
                                    <InputText
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
                                <div class="flex flex-col gap-1 text-left">
                                    <FormField
                                        v-slot="$field"
                                        name="password"
                                        class="flex flex-col gap-1"
                                    >
                                        <label for="password">Password</label>
                                        <Password
                                            type="text"
                                            placeholder="Password"
                                            :feedback="false"
                                            toggle-mask
                                            fluid
                                        />
                                        <Message
                                            v-if="$field?.invalid"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{ $field.error?.message }}</Message
                                        >
                                        <div class="text-right mb-4">
                                            <RouterLink to="/forgot-password" class="font-semibold"
                                                >Forgot your password?</RouterLink
                                            >
                                        </div>
                                    </FormField>
                                </div>
                                <Button type="submit" label="Log in" />
                            </Form>
                            <div class="text-center">
                                <span class="text-muted-color mr-1"> Don't have an account?</span>
                                <RouterLink to="register" class="font-semibold">
                                    Sign Up</RouterLink
                                >
                            </div>
                        </div>
                    </template>
                </Card>
            </div>
        </div>
    </PublicLayout>
</template>
<script setup>
import PublicLayout from '@storefront/layouts/PublicLayout.vue'
import { Form, FormField } from '@primevue/forms'
import { Button, Card, InputText, Message, Password } from 'primevue'
import { useAuthStore } from '@admin/stores/auth'
import { loginValidator } from '@storefront/validators/loginValidator'
import { useRedirects } from '@storefront/composables/useRedirects'
import { useCustomToast } from '@storefront/composables/useCustomToast'

const { customToast } = useCustomToast()
const { login } = useAuthStore()
const { toHome } = useRedirects()

const onFormSubmit = async ({ valid, values, errors }) => {
    if (valid) {
        try {
            await login(values.email, values.password)
            toHome()
        } catch (error) {
            const msg = error?.response?.data?.message
            customToast.error(msg || 'Please try again.')
        }
    } else {
        customToast.error(`${Object.keys(errors).length} field contains errors`)
    }
}
</script>
