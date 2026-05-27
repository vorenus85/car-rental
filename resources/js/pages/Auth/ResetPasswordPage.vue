<template>
    <main>
        <div class="h-screen flex items-center justify-center flex-col">
            <div class="mb-5"><LogoIcon /></div>
            <Card class="p-4 py-6 w-full sm:max-w-lg">
                <template #content>
                    <div
                        class="flex flex-col gap-6 md:gap-8 items-center justify-center text-center"
                    >
                        <div class="text-xl"><strong>Reset password</strong></div>
                        <div class="text-center">Please enter your new password below</div>
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
                            <Button class="mt-4" type="submit" label="Reset password" />
                        </Form>
                    </div>
                </template>
            </Card>
        </div>
    </main>
</template>
<script setup>
import LogoIcon from '@/components/LogoIcon.vue'
import { Form } from '@primevue/forms'
import { Button, Card, InputText, Message, Password } from 'primevue'
import { reactive, ref } from 'vue'
import { resetPasswordValidator } from '@/validators/resetPasswordValidator'
import { resetPassword } from '@/services/authService'
import { useRoute } from 'vue-router'
import { useCustomToast } from '@/composables/useCustomToast'
import { useRedirects } from '@/composables/useRedirects'

const { customToast } = useCustomToast()
const { toLogin } = useRedirects()
const route = useRoute()
const password = ref(null)
const password_confirmation = ref(null)

const initialValues = reactive({
    email: route.query.email,
    token: route.query.token,
})

const onFormSubmit = async ({ valid, values }) => {
    if (valid) {
        try {
            const { data } = await resetPassword(values)
            customToast.success(data?.message)
            setTimeout(() => {
                toLogin()
            }, 300)
        } catch (error) {
            console.log(error)
            const msg = error?.response?.data?.message
            customToast.error(msg || 'Please try again.')
        }
    }
}
</script>
