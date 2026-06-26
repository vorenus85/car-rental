<template>
    <main>
        <div class="h-screen flex items-center justify-center flex-col p-4">
            <div class="mb-5"><LogoIcon /></div>
            <Card class="p-4 py-6 w-full sm:max-w-lg">
                <template #content>
                    <div
                        class="flex flex-col gap-6 md:gap-8 items-center justify-center text-center"
                    >
                        <div class="text-xl">
                            <strong>{{ $t('pages.register.title') }}</strong>
                        </div>
                        <div class="text-center">
                            {{ $t('pages.register.subTitle') }}
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
                                <label for="name">{{ $t('form.name') }}</label>
                                <InputText
                                    id="name"
                                    name="name"
                                    type="name"
                                    :placeholder="$t('form.name')"
                                    fluid
                                />
                                <Message
                                    v-if="$form.name?.invalid"
                                    severity="error"
                                    size="small"
                                    variant="simple"
                                    >{{ $t($form.name.error?.key) }}</Message
                                >
                            </div>
                            <div class="flex flex-col gap-1 text-left">
                                <label for="email">{{ $t('form.emailAddress') }}</label>
                                <InputText
                                    id="email"
                                    name="email"
                                    type="email"
                                    :placeholder="$t('form.emailAddress')"
                                    fluid
                                />
                                <Message
                                    v-if="$form.email?.invalid"
                                    severity="error"
                                    size="small"
                                    variant="simple"
                                    >{{ $t($form.email.error?.key) }}</Message
                                >
                            </div>
                            <div class="flex flex-col gap-1 text-left">
                                <label for="password">{{ $t('form.password') }}</label>
                                <Password
                                    input-id="password"
                                    name="password"
                                    type="text"
                                    :placeholder="$t('form.password')"
                                    min="8"
                                    :value="password"
                                    :prompt-label="$t('form.choosePassword')"
                                    :weak-label="$t('form.passwordSimple')"
                                    :medium-label="$t('form.passwordAverage')"
                                    :strong-label="$t('form.passwordComplex')"
                                    toggle-mask
                                    fluid
                                />
                                <Message
                                    v-if="$form.password?.invalid"
                                    severity="error"
                                    size="small"
                                    variant="simple"
                                    >{{ $t($form.password.error?.key) }}</Message
                                >
                            </div>
                            <div class="flex flex-col gap-1 text-left">
                                <label for="password_confirmation">{{
                                    $t('form.confirmPassword')
                                }}</label>
                                <Password
                                    input-id="password_confirmation"
                                    name="password_confirmation"
                                    type="text"
                                    :placeholder="$t('form.confirmPassword')"
                                    min="8"
                                    :value="password_confirmation"
                                    :prompt-label="$t('form.choosePassword')"
                                    :weak-label="$t('form.passwordSimple')"
                                    :medium-label="$t('form.passwordAverage')"
                                    :strong-label="$t('form.passwordComplex')"
                                    toggle-mask
                                    fluid
                                />
                                <Message
                                    v-if="$form.password_confirmation?.invalid"
                                    severity="error"
                                    size="small"
                                    variant="simple"
                                    >{{ $t($form.password_confirmation.error?.key) }}</Message
                                >
                            </div>
                            <Button class="mt-4" type="submit" :label="$t('pages.register.btn')" />
                        </Form>
                        <div class="text-center">
                            <span class="text-muted-color mr-1">
                                {{ $t('pages.register.haveAccount') }}
                            </span>
                            <RouterLink to="/" class="font-semibold">
                                {{ $t('pages.register.logIn') }}</RouterLink
                            >
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
import { Button, Card, InputText, Message, Password } from 'primevue'
import { useRedirects } from '@/composables/useRedirects'
import { useCustomToast } from '@/composables/useCustomToast'
import { registerValidator } from '@/validators/registerValidator'
import { useAuthStore } from '@/stores/useAuthStore'
import { registerVisitor } from '@/services/userService'
import { ref } from 'vue'
import { useI18n } from 'vue-i18n'

const { t } = useI18n()
const { login } = useAuthStore()
const { customToast } = useCustomToast()
const { toDashboard } = useRedirects()
const password = ref(null)
const password_confirmation = ref(null)

const onFormSubmit = async ({ valid, values }) => {
    if (valid) {
        try {
            await registerVisitor(values)
            await login(values.email, values.password)

            customToast.success(t('toast.register.success'))

            setTimeout(() => {
                toDashboard()
            }, 300)
        } catch (error) {
            console.error(error)
            const msg = error?.response?.data?.message
            customToast.error(msg || t('toast.tryAgain'))
        }
    }
}
</script>
