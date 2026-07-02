<template>
    <PublicLayout class="login-page">
        <div class="mx-auto max-w-8xl px-4 py-4 min-h-[500px]">
            <BreadcrumbModule :items="breadcrumbItems"></BreadcrumbModule>
            <div class="flex items-center justify-center flex-col mt-5 mb-5">
                <Card class="p-4 py-6 w-full sm:max-w-lg">
                    <template #content
                        ><LoginPanel @login-submit="onFormSubmit"></LoginPanel>
                    </template>
                </Card>
            </div>
        </div>
    </PublicLayout>
</template>
<script setup>
import PublicLayout from '@storefront/layouts/PublicLayout.vue'
import BreadcrumbModule from '@storefront/components/modules/BreadcrumbModule.vue'
import { useAuthStore } from '@storefront/stores/authStore'
import { useRedirects } from '@storefront/composables/useRedirects'
import { useCustomToast } from '@storefront/composables/useCustomToast'
import { computed, nextTick } from 'vue'
import LoginPanel from '@storefront/components/modules/LoginPanel.vue'
import { Card } from 'primevue'

const breadcrumbItems = computed(() => [
    {
        label: 'Login',
    },
])

const { customToast } = useCustomToast()
const { login } = useAuthStore()
const { toHome } = useRedirects()

const onFormSubmit = async ({ valid, values, errors }) => {
    if (valid) {
        try {
            await login(values.email, values.password)

            await nextTick()

            customToast.success('Welcome on Drivengo!')

            await toHome()
        } catch (error) {
            const msg = error?.response?.data?.message
            customToast.error(msg || 'Please try again.')
        }
    } else {
        customToast.error(`${Object.keys(errors).length} field contains errors`)
    }
}
</script>
