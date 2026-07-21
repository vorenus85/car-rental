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
                    <div class="payment-types mb-5">
                        <div class="space-y-4">
                            <h2 class="text-lg font-semibold">Payment method</h2>

                            <!-- Card -->
                            <div
                                class="border border-surface-200 background-white rounded-xl p-5"
                                :class="paymentMethod === 'card' ? 'border-primary' : ''"
                            >
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center gap-3">
                                        <RadioButton
                                            v-model="paymentMethod"
                                            input-id="card"
                                            value="card"
                                        />

                                        <label
                                            for="card"
                                            class="cursor-pointer"
                                            :class="paymentMethod === 'card' ? 'font-semibold' : ''"
                                        >
                                            Credit / Debit Card
                                        </label>
                                    </div>

                                    <div class="flex gap-2">
                                        <img
                                            :src="'/images/payment/visa.svg'"
                                            class="h-7"
                                            alt="visa"
                                        />
                                        <img
                                            :src="'/images/payment/mastercard.svg'"
                                            class="h-7"
                                            alt="mastercard"
                                        />
                                        <img
                                            :src="'/images/payment/maestro.svg'"
                                            class="h-7"
                                            alt="maestro"
                                        />
                                    </div>
                                </div>

                                <div v-if="paymentMethod === 'card'" class="mt-5 space-y-4">
                                    <div>
                                        <label for="card" class="text-sm text-gray-600">
                                            Card Number
                                        </label>

                                        <InputText
                                            v-model="card.number"
                                            input-id="card"
                                            class="w-full mt-1"
                                            placeholder="1234 5678 9012 3456"
                                        />
                                    </div>

                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label for="expire-date" class="text-sm text-gray-600">
                                                Expiry Date
                                            </label>

                                            <InputText
                                                v-model="card.expiry"
                                                input-id="expire-date"
                                                class="w-full mt-1"
                                                placeholder="MM / YY"
                                            />
                                        </div>

                                        <div>
                                            <label for="ccv" class="text-sm text-gray-600">
                                                CVC / CVV
                                            </label>

                                            <InputText
                                                v-model="card.cvc"
                                                input-id="ccv"
                                                class="w-full mt-1"
                                                placeholder="123"
                                            />
                                        </div>
                                    </div>

                                    <div>
                                        <label for="holder" class="text-sm text-gray-600">
                                            Cardholder Name
                                        </label>

                                        <InputText
                                            v-model="card.holder"
                                            input-id="holder"
                                            class="w-full mt-1"
                                            placeholder="JOHN SINCLAIR"
                                        />
                                    </div>
                                </div>
                            </div>

                            <!-- Cash -->
                            <label
                                for="cash"
                                class="border rounded-xl p-4 cursor-pointer block border-surface-200 background-white"
                                :class="paymentMethod === 'cash' ? 'border-primary' : ''"
                            >
                                <div class="flex items-center gap-3">
                                    <RadioButton
                                        v-model="paymentMethod"
                                        input-id="cash"
                                        value="cash"
                                    />

                                    <span :class="paymentMethod === 'cash' ? 'font-semibold' : ''"
                                        >Pay cash on Pickup</span
                                    >
                                </div>

                                <p class="text-sm text-gray-500 mt-2 ml-8">
                                    The full amount is payable in cash when you pick up the vehicle.
                                </p>
                            </label>
                        </div>
                    </div>
                    <div class="space-y-4 mt-5 pt-5 pb-5 mb-5">
                        <div class="flex items-start gap-3">
                            <Checkbox v-model="form.acceptTerms" inputId="terms" binary />

                            <label
                                for="terms"
                                class="text-sm text-surface-700 leading-5 cursor-pointer"
                            >
                                I accept the
                                <a
                                    href="/terms-and-conditions"
                                    target="_blank"
                                    class="font-medium text-secondary hover:underline"
                                >
                                    Terms &amp; Conditions
                                </a>
                                <span class="text-red-500">*</span>
                            </label>
                        </div>

                        <div class="flex items-start gap-3">
                            <Checkbox v-model="form.acceptPrivacy" inputId="privacy" binary />

                            <label
                                for="privacy"
                                class="text-sm text-surface-700 leading-5 cursor-pointer"
                            >
                                I accept the
                                <a
                                    href="/privacy-policy"
                                    target="_blank"
                                    class="font-medium text-secondary hover:underline"
                                >
                                    Privacy Policy
                                </a>
                                <span class="text-red-500">*</span>
                            </label>
                        </div>
                    </div>
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
                :disabled="!hasAcceptedPolicies"
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
import FreeCancelation from '@storefront/components/modules/FreeCancelation.vue'
import { Checkbox, InputText, Message, RadioButton } from 'primevue'
import { computed, reactive, ref } from 'vue'

const paymentMethod = ref('card')

const card = ref({
    number: '',
    expiry: '',
    cvc: '',
    holder: '',
})

const form = reactive({
    acceptTerms: false,
    acceptPrivacy: false,
})

const hasAcceptedPolicies = computed(() => {
    return form.acceptTerms && form.acceptPrivacy
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

const handleNext = () => {
    console.log('payment')
}
</script>
