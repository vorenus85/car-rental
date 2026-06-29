<template>
    <PublicLayout class="register-page">
        <div class="mx-auto max-w-8xl px-4 py-4 min-h-[500px]">
            <BreadcrumbModule :items="breadcrumbItems"></BreadcrumbModule>
            <div class="flex items-center justify-center flex-col mt-5 mb-5">
                <Card class="p-4 py-6 w-full sm:max-w-lg">
                    <template #content>
                        <div
                            class="flex flex-col gap-6 md:gap-8 items-center justify-center text-center"
                        >
                            <div class="text-xl">
                                <strong>Create an account</strong>
                            </div>
                            <div class="text-center">
                                Enter your details below to create your account
                            </div>
                            <Form
                                v-slot="$form"
                                class="flex flex-col gap-4 w-full"
                                :resolver="registerValidator"
                                :validate-on-value-update="true"
                                :validate-on-blur="true"
                                @submit="onFormSubmit"
                            >
                                <div class="flex flex-col gap-1 text-left">
                                    <label for="name">Name</label>
                                    <InputText id="name" name="name" :placeholder="'Name'" fluid />
                                    <Message
                                        v-if="$form.name?.invalid"
                                        severity="error"
                                        size="small"
                                        variant="simple"
                                        >{{ $form.name.error?.message }}</Message
                                    >
                                </div>
                                <div class="flex flex-col gap-1 text-left">
                                    <label for="email">Email address</label>
                                    <InputText
                                        id="email"
                                        name="email"
                                        type="email"
                                        :placeholder="'Email address'"
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
                                    <label for="phone">Phone number</label>
                                    <InputText
                                        id="phone"
                                        name="phone"
                                        :placeholder="'phone'"
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
                                <div class="flex flex-col gap-1 text-left">
                                    <label for="password">Password</label>
                                    <Password
                                        input-id="password"
                                        name="password"
                                        type="text"
                                        :placeholder="'Password'"
                                        min="8"
                                        :value="password"
                                        prompt-label="Choose a password"
                                        weak-label="Too simple"
                                        medium-label="Average complexity"
                                        strong-label="Complex password"
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
                                <div class="flex flex-col gap-1 text-left">
                                    <label for="password_confirmation">Confirm password</label>
                                    <Password
                                        input-id="password_confirmation"
                                        name="password_confirmation"
                                        type="text"
                                        :placeholder="'Confirm password'"
                                        min="8"
                                        :value="password_confirmation"
                                        prompt-label="Choose a password"
                                        weak-label="Too simple"
                                        medium-label="Average complexity"
                                        strong-label="Complex password"
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
                                <Button class="mt-4" type="submit" :label="'Create account'" />
                            </Form>
                            <div class="text-center">
                                <span class="text-muted-color mr-1">
                                    Already have an account?
                                </span>
                                <RouterLink to="/login" class="font-semibold"> Log in</RouterLink>
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
import BreadcrumbModule from '@storefront/components/modules/BreadcrumbModule.vue'
import { Form } from '@primevue/forms'
import { Button, Card, InputText, Message, Password } from 'primevue'
import { useRedirects } from '@storefront/composables/useRedirects'
import { useCustomToast } from '@storefront/composables/useCustomToast'
import { registerValidator } from '@storefront/validators/registerValidator'
import { useAuthStore } from '@storefront/stores/authStore'
import { doRegister } from '@storefront/services/authService'
import { computed, nextTick, ref } from 'vue'

const breadcrumbItems = computed(() => [
    {
        label: 'Register',
    },
])

const { login } = useAuthStore()
const { customToast } = useCustomToast()
const { toHome } = useRedirects()
const password = ref(null)
const password_confirmation = ref(null)

const onFormSubmit = async ({ valid, values }) => {
    if (valid) {
        try {
            await doRegister(values)
            await login(values.email, values.password)

            customToast.success('Welcome on Drivengo!')

            await nextTick()

            await toHome()
        } catch (error) {
            console.error(error)
            const msg = error?.response?.data?.message
            customToast.error(msg || 'Please try again.')
        }
    }
}
</script>
