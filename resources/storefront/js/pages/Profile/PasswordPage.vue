<template>
    <PublicLayout class="profile-password-page">
        <div class="mx-auto max-w-8xl px-4 py-4 min-h-[500px]">
            <BreadcrumbModule :items="breadcrumbItems"></BreadcrumbModule>
            <PageTitle title="Password management"></PageTitle>
            <div class="mb-10">
                <p class="mt-2 text-sm text-slate-500">
                    Ensure your account is using a long, random password to stay secure.
                </p>
            </div>
            <div class="mt-5 grid grid-cols-1 gap-8 lg:grid-cols-[280px_minmax(0,1fr)] items-start">
                <ProfileSidebar />
                <div class="mb-10">
                    <Form
                        ref="formRef"
                        v-slot="$form"
                        :resolver="changePasswordValidator"
                        class="flex flex-col gap-4 w-full"
                        :validate-on-value-update="true"
                        :validate-on-blur="true"
                        @submit="onFormSubmit"
                    >
                        <div class="flex flex-col gap-1 text-left">
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
                        <div class="flex flex-col gap-1 text-left">
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
                        <div class="flex flex-col gap-1 text-left">
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
                        <div class="flex gap-1 text-left">
                            <Button
                                type="submit"
                                severity="primary"
                                label="Save"
                                class="w-32 mt-4"
                            />
                        </div>
                    </Form>
                </div>
            </div>
        </div>
    </PublicLayout>
</template>
<script setup>
import PublicLayout from '@storefront/layouts/PublicLayout.vue'
import PageTitle from '@storefront/components/modules/PageTitle.vue'
import BreadcrumbModule from '@storefront/components/modules/BreadcrumbModule.vue'
import ProfileSidebar from '@storefront/components/modules/Profile/ProfileSidebar.vue'
import { useCustomToast } from '@storefront/composables/useCustomToast'
import { editPassword } from '@storefront/services/authService'
import { Form } from '@primevue/forms'
import { Button, Message, Password } from 'primevue'
import { changePasswordValidator } from '@storefront/validators/changePasswordValidator'
import { ref } from 'vue'

const breadcrumbItems = [
    {
        label: 'Profile',
        route: '/profile',
    },
    {
        label: 'Password management',
    },
]

const { customToast } = useCustomToast()
const formRef = ref(null)
const password = ref(null)
const password_confirmation = ref(null)

const onFormSubmit = async ({ valid, values, errors }) => {
    if (valid) {
        try {
            await editPassword(values)
            formRef.value?.reset()

            customToast.success('Password updated successfully.')
        } catch (error) {
            console.error(error)
            const msg = error?.response?.data?.message
            customToast.error(msg || 'Please try again.')
        }
    } else {
        customToast.error(`${Object.keys(errors).length} field contains errors`)
    }
}
</script>
