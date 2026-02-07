<template>
    <main>
        <div class="h-screen flex items-center justify-center flex-col">
            <div><LogoIcon class="mb-5" /></div>
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
                            <div class="flex flex-col gap-1">
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
                            <div class="flex flex-col gap-1">
                                <FormField
                                    v-slot="$field"
                                    name="password"
                                    class="flex flex-col gap-1"
                                >
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
import UiIcon from '@/components/UiIcon.vue'
import LogoIcon from '@/components/LogoIcon.vue'
import { Form, FormField } from '@primevue/forms'
import { Button, Card, InputText, Message, Password, Tag } from 'primevue'
import { useAuthStore } from '@/stores/auth'
import { useAuth } from '@/composables/useAuth'
import { useToast } from 'primevue/usetoast'
import { useRedirects } from '@/composables/useRedirects'

const toast = useToast()
const { login } = useAuthStore()
const { loginValidator } = useAuth()
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

const onFormSubmit = async ({ valid, values }) => {
    if (valid) {
        try {
            await login(values.email, values.password)
            toDashboard()
        } catch (err) {
            console.log(err)
            toast.add({
                severity: 'error',
                summary: 'Wrong email or password!',
                life: 3000,
            })
        }
    }
}
</script>
