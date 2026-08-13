<template>
    <PublicLayout class="profile-basic-details-page">
        <div class="mx-auto max-w-8xl px-4 py-4 min-h-[500px]">
            <BreadcrumbModule :items="breadcrumbItems"></BreadcrumbModule>
            <PageTitle title="Basic Details"></PageTitle>
            <div class="mb-10">
                <p class="mt-2 text-sm text-slate-500">
                    Update your personal details, including your name, email address, and phone
                    number.
                </p>
            </div>
            <div
                class="flex flex-col gap-6 md:gap-8 items-center justify-center text-center mt-5 mb-5"
            >
                <div v-if="isReady" class="w-full">
                    <Form
                        v-slot="$form"
                        class="flex flex-col gap-4 w-full"
                        :initial-values="initialValues"
                        :resolver="basicDetailsValidator"
                        :validate-on-value-update="true"
                        :validate-on-blur="true"
                        @submit="onFormSubmit"
                    >
                        <div class="flex flex-col gap-1 text-left">
                            <label for="name">First Name</label>
                            <InputText id="firstName" name="firstName" placeholder="John" fluid />
                            <Message
                                v-if="$form.firstName?.invalid"
                                severity="error"
                                size="small"
                                variant="simple"
                                >{{ $form.firstName.error?.message }}</Message
                            >
                        </div>
                        <div class="flex flex-col gap-1 text-left">
                            <label for="lastName">Name</label>
                            <InputText id="lastName" name="lastName" placeholder="Doe" fluid />
                            <Message
                                v-if="$form.lastName?.invalid"
                                severity="error"
                                size="small"
                                variant="simple"
                                >{{ $form.lastName.error?.message }}</Message
                            >
                        </div>
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
                            <label for="phone">Phone number</label>
                            <InputText id="phone" name="phone" placeholder="Phone number" fluid />
                            <Message
                                v-if="$form.phone?.invalid"
                                severity="error"
                                size="small"
                                variant="simple"
                                >{{ $form.phone.error?.message }}</Message
                            >
                        </div>
                        <div class="flex gap-1 text-left">
                            <Button class="mt-4 w-32" type="submit" :label="'Save'" />
                        </div>
                    </Form>
                </div>
                <div v-else class="w-full text-center text-muted-color">
                    Loading profile details...
                </div>
            </div>
        </div>
    </PublicLayout>
</template>
<script setup>
import PublicLayout from '@storefront/layouts/PublicLayout.vue'
import PageTitle from '@storefront/components/modules/PageTitle.vue'
import BreadcrumbModule from '@storefront/components/modules/BreadcrumbModule.vue'
import { useAuthStore } from '@storefront/stores/authStore'
import { useCustomToast } from '@storefront/composables/useCustomToast'
import { editBasicDetails } from '@storefront/services/authService'
import { Form } from '@primevue/forms'
import { Button, InputText, Message } from 'primevue'
import { basicDetailsValidator } from '@storefront/validators/basicDetailsValidator'
import { computed, onMounted, ref } from 'vue'

const { customToast } = useCustomToast()
const authStore = useAuthStore()
const isReady = ref(false)

const initialValues = computed(() => ({
    firstName: authStore.user?.firstName ?? authStore.user?.first_name ?? '',
    lastName: authStore.user?.lastName ?? authStore.user?.last_name ?? '',
    email: authStore.user?.email ?? '',
    phone: authStore.user?.phone ?? '',
}))

const breadcrumbItems = [
    {
        label: 'Profile',
        route: '/profile',
    },
    {
        label: 'Basic details',
    },
]

onMounted(async () => {
    await authStore.init()
    isReady.value = true
})

const onFormSubmit = async ({ valid, values }) => {
    if (valid) {
        try {
            const response = await editBasicDetails(values)

            authStore.user = response.data.customer

            customToast.success('Profile basic details updated successfully.')
        } catch (error) {
            console.error(error)
            const msg = error?.response?.data?.message
            customToast.error(msg || 'Please try again.')
        }
    }
}
</script>
