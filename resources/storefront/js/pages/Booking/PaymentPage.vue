<template>
    <PublicLayout class="booking-page-3">
        <div class="mx-auto max-w-8xl px-4 py-4 min-h-[500px]">
            <BreadcrumbModule :items="breadcrumbItems"></BreadcrumbModule>
            <BookingSteppes :active="3" class="pb-5" />
            <div class="grid grid-cols-1 gap-8 md:grid-cols-3 pt-5">
                <div class="md:col-span-2">
                    <PageTitle
                        title="Payment & Checkout"
                        subtitle="Select your payment method and complete your order."
                        class="mb-5"
                    ></PageTitle>
                    <PaymentMethod v-model="paymentMethod"></PaymentMethod>
                    <BookingNotes v-model="notes"></BookingNotes>
                    <BookingAccepts
                        v-model:accept-terms="acceptTerms"
                        v-model:accept-privacy="acceptPrivacy"
                    ></BookingAccepts>
                    <Message v-if="!hasAcceptedPolicies" severity="info" size="small"
                        >Please accept the Terms & Conditions and Privacy Policy to
                        continue.</Message
                    >
                    <FreeCancelation class="mt-5"></FreeCancelation>
                </div>
                <div class="md:col-span-1">
                    <BookingDriverSummary class="mb-5"></BookingDriverSummary>
                    <BookingSidebarSummary></BookingSidebarSummary>
                </div>
            </div>
            <BookingNavigation
                class="pt-5"
                :back-label="'Back to Driver details'"
                :next-label="'Complete Booking'"
                :disabled="!hasAcceptedPolicies"
                :loading="submitting"
                :icon="'lock'"
                :icon-pos="'left'"
                @back="handleBack"
                @next="handleNext"
            ></BookingNavigation>
        </div>
    </PublicLayout>
</template>
<script setup>
import PublicLayout from '@storefront/layouts/PublicLayout.vue'
import PageTitle from '@storefront/components/modules/PageTitle.vue'
import BookingSteppes from '@storefront/components/modules/Booking/BookingSteppes.vue'
import BreadcrumbModule from '@storefront/components/modules/BreadcrumbModule.vue'
import BookingNavigation from '@storefront/components/modules/Booking/BookingNavigation.vue'
import BookingSidebarSummary from '@storefront/components/modules/Booking/BookingSidebarSummary.vue'
import BookingDriverSummary from '@storefront/components/modules/Booking/BookingDriverSummary.vue'
import PaymentMethod from '@storefront/components/modules/Payment/PaymentMethod.vue'
import BookingNotes from '@storefront/components/modules/Payment/BookingNotes.vue'
import BookingAccepts from '@storefront/components/modules/Payment/BookingAccepts.vue'
import FreeCancelation from '@storefront/components/modules/FreeCancelation.vue'
import { useRouter } from 'vue-router'
import { Message } from 'primevue'
import { computed, ref } from 'vue'
import { useBookingStore } from '@storefront/stores/bookingStore'
import { useBookingLookupStore } from '@storefront/stores/bookingLookupStore'
import { useAuthStore } from '@storefront/stores/authStore'
import { createBooking } from '@storefront/services/bookingService'
import { useCustomToast } from '@storefront/composables/useCustomToast'

const router = useRouter()
const bookingStore = useBookingStore()
const bookingLookupStore = useBookingLookupStore()
const authStore = useAuthStore()
const { customToast } = useCustomToast()

const submitting = ref(false)

const paymentMethod = ref('stripe')
const notes = ref('')
const acceptTerms = ref(false)
const acceptPrivacy = ref(false)

const hasAcceptedPolicies = computed(() => {
    return acceptTerms.value && acceptPrivacy.value
})

const breadcrumbItems = [
    {
        label: 'Fleet',
        route: '/fleet',
    },
    {
        label: 'Payment and Confirmation',
    },
]

const handleBack = () => {
    globalThis.history.back()
}

const buildBookingPayload = () => {
    const {
        carId,
        pickUpLocationId,
        dropOffLocationId,
        pickUpDate,
        pickUpTime,
        dropOffDate,
        dropOffTime,
    } = bookingStore.getBookingData
    const { firstName, lastName, phone, birthDate } = bookingStore.getDriverPersonal
    const licence = bookingStore.getDriverLicence

    return {
        carId,
        payment_method: paymentMethod.value,
        customerId: authStore.user?.id,
        pickUpLocationId,
        dropOffLocationId,
        pickUpDate,
        dropOffDate,
        pickUpTime,
        dropOffTime,
        notes: notes.value || null,
        driver_first_name: firstName,
        driver_last_name: lastName,
        driver_phone: phone,
        driver_birth_date: birthDate,

        driver_licence_number: licence.licenceNumber,
        driver_licence_country: licence.issuingCountry,
        driver_licence_issue_date: licence.issueDate,
        driver_licence_expiry_date: licence.expiryDate,
        insurance_id: bookingStore.insuranceId,
        extras: bookingStore.extras,
        accept_terms: acceptTerms.value,
        accept_privacy: acceptPrivacy.value,
    }
}

const handleNext = async () => {
    if (submitting.value || !hasAcceptedPolicies.value) {
        return
    }

    submitting.value = true

    try {
        const { data } = await createBooking(buildBookingPayload())
        const booking = data?.booking

        customToast.success('Booking completed successfully.')

        // delete booking data from store
        bookingStore.clearBookingData()
        bookingLookupStore.clearBookingData()

        router.push({
            name: 'booking-success',
            query: {
                publicId: booking?.public_id,
            },
        })
    } catch (error) {
        const message = error?.response?.data?.message || 'We could not complete the booking.'
        customToast.error(message)
        router.push({ name: 'booking-failure' })
    } finally {
        submitting.value = false
    }
}
</script>
