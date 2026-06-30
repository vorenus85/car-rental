<template>
    <PublicLayout class="reset-password-page">
        <div class="mx-auto max-w-8xl px-4 py-4 min-h-[500px]">
            <div class="flex items-center justify-center flex-col mt-5 mb-5">
                <Card class="p-4 py-6 w-full sm:max-w-lg">
                    <template #content>
                        <div
                            class="flex flex-col gap-6 md:gap-8 items-center justify-center text-center"
                        >
                            <div class="text-xl">
                                <strong>{{ texts[pageType].title }}</strong>
                            </div>
                            <div class="text-center">{{ texts[pageType].subtitle }}</div>
                            <Form
                                v-slot="$form"
                                class="flex flex-col gap-4 w-full"
                                :initial-values="initialValues"
                                :resolver="resetPasswordValidator"
                                :validate-on-value-update="true"
                                :validate-on-blur="true"
                                @submit="onFormSubmit"
                            >
                                <InputText type="text" hidden name="token" />
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
                                <div class="flex flex-col gap-1 text-left">
                                    <label for="password">New password</label>
                                    <Password
                                        input-id="password"
                                        name="password"
                                        type="text"
                                        placeholder="New password"
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
                                        placeholder="Confirm password"
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
                                <Button class="mt-4" type="submit" :label="texts[pageType].btn" />
                            </Form>
                        </div>
                    </template>
                </Card>
            </div>
        </div>
    </PublicLayout>
</template>
<script setup>
import PublicLayout from '@storefront/layouts/PublicLayout.vue'
import { Form } from '@primevue/forms'
import { Button, Card, InputText, Message, Password } from 'primevue'
import { computed, reactive, ref } from 'vue'
import { resetPasswordValidator } from '@storefront/validators/resetPasswordValidator'
import { resetPassword } from '@storefront/services/authService'
import { useRoute } from 'vue-router'
import { useCustomToast } from '@storefront/composables/useCustomToast'
import { useRedirects } from '@storefront/composables/useRedirects'

const { customToast } = useCustomToast()
const { toLogin } = useRedirects()
const route = useRoute()
const password = ref(null)
const password_confirmation = ref(null)

const initialValues = reactive({
    email: route.query.email,
    token: route.query.token,
})

const texts = {
    pwdReset: {
        title: 'Reset password',
        subtitle: 'Please enter your new password below',
        btn: 'Reset password',
    },
    firstSetup: {
        title: 'Set your password',
        subtitle: 'Welcome! Create a password to activate your administrator account.',
        btn: 'Set password',
    },
}

const pageType = computed(() => {
    return route.query?.type === 'welcome' ? 'firstSetup' : 'pwdReset'
})

const onFormSubmit = async ({ valid, values, errors }) => {
    if (valid) {
        try {
            const { data } = await resetPassword(values)
            customToast.success(data?.message)
            setTimeout(() => {
                toLogin()
            }, 300)
        } catch (error) {
            // console.error(error)
            const msg = error?.response?.data?.message
            customToast.error(msg || 'Please try again.')
        }
    } else {
        customToast.error(`${Object.keys(errors).length} field contains errors`)
    }
}
</script>
