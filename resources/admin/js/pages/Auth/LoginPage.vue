<template>
    <main>
        <div class="h-screen flex items-center justify-center flex-col">
            <div class="mb-5"><LogoIcon /></div>
            <Card class="p-4 py-6 w-full sm:max-w-lg">
                <template #content>
                    <div
                        class="flex flex-col gap-6 md:gap-8 items-center justify-center text-center"
                    >
                        <div class="text-xl"><strong>Log in to Wheelzie Dashboard</strong></div>
                        <div class="text-center">Enter your email and password below to log in</div>

                        <div>
                            <strong>Demo Dashboard Access</strong><br />
                            Use the credentials below to log in:
                            <br />
                            <Tag
                                v-tooltip.top="'Copy to clipboard'"
                                class="mb-2 mt-3 cursor-pointer"
                                severity="info"
                                @click="setClipboard(demoEmail)"
                                >{{ demoEmail }} <UiIcon icon="clipboard"></UiIcon></Tag
                            ><br />
                            <Tag
                                v-tooltip.top="'Copy to clipboard'"
                                class="cursor-pointer"
                                severity="info"
                                @click="setClipboard(demoPassword)"
                                >{{ demoPassword }} <UiIcon icon="clipboard"></UiIcon
                            ></Tag>
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
                    </div>
                </template>
            </Card>
        </div>
    </main>
</template>
<script setup lang="ts">
import UiIcon from '@admin/components/UiIcon.vue'
import LogoIcon from '@admin/components/LogoIcon.vue'
import { Form, FormField } from '@primevue/forms'
import { Button, Card, InputText, Message, Password, Tag } from 'primevue'
import { useAuthStore } from '@admin/stores/auth'
import { loginValidator } from '@admin/validators/loginValidator'
import { useRedirects } from '@admin/composables/useRedirects'
import { useCustomToast } from '@admin/composables/useCustomToast'

const { customToast } = useCustomToast()
const { login } = useAuthStore()
const { toDashboard } = useRedirects()

const demoEmail = import.meta.env.VITE_DEMO_EMAIL
const demoPassword = import.meta.env.VITE_DEMO_PASSWORD

const setClipboard = async text => {
    const type = 'text/plain'
    const clipboardItemData = {
        [type]: text,
    }
    const clipboardItem = new ClipboardItem(clipboardItemData)
    await navigator.clipboard.write([clipboardItem])
}

const onFormSubmit = async ({ valid, values, errors }) => {
    if (valid) {
        try {
            await login(values.email, values.password)
            toDashboard()
        } catch (error) {
            const msg = error?.response?.data?.message
            customToast.error(msg || 'Please try again.')
        }
    } else {
        customToast.error(`${Object.keys(errors).length} field contains errors`)
    }
}
</script>
