<template>
    <PublicLayout class="booking-failure-page">
        <div class="mx-auto max-w-8xl px-4 py-4 min-h-[500px]">
            <div
                class="mx-auto w-full max-w-4xl rounded-3xl bg-white shadow-xl p-10 text-center mb-5 mt-5"
            >
                <!-- Error Icon -->
                <div
                    class="mx-auto mb-8 flex h-24 w-24 items-center justify-center rounded-full bg-red-100"
                >
                    <i class="pi pi-times-circle text-6xl text-red-500"></i>
                </div>

                <!-- Title -->
                <h1 class="text-4xl font-bold text-surface-900">Booking Failed</h1>

                <p class="mt-4 text-lg text-surface-600 leading-relaxed">
                    Unfortunately, we couldn't complete your booking. This may have happened because
                    the payment was declined, the selected vehicle is no longer available, or a
                    temporary system error occurred.
                </p>

                <div class="mt-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4">
                    <p class="font-semibold text-red-700">No booking has been confirmed.</p>
                </div>

                <!-- Possible Reasons -->
                <div
                    class="mt-10 rounded-2xl border border-surface-200 bg-surface-50 p-6 text-left"
                >
                    <h2 class="mb-5 text-xl font-semibold text-surface-900">
                        What could have happened?
                    </h2>

                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <i class="pi pi-times-circle mt-1 text-red-500"></i>
                            <span class="text-surface-700"> Payment authorization failed. </span>
                        </li>

                        <li class="flex items-start gap-3">
                            <i class="pi pi-clock mt-1 text-orange-500"></i>
                            <span class="text-surface-700"> Your booking session expired. </span>
                        </li>

                        <li class="flex items-start gap-3">
                            <i class="pi pi-car mt-1 text-blue-500"></i>
                            <span class="text-surface-700">
                                The selected vehicle is no longer available.
                            </span>
                        </li>

                        <li class="flex items-start gap-3">
                            <i class="pi pi-server mt-1 text-purple-500"></i>
                            <span class="text-surface-700">
                                A temporary server error occurred.
                            </span>
                        </li>
                    </ul>
                </div>

                <!-- Buttons -->
                <div class="mt-10 flex flex-col gap-4 sm:flex-row sm:justify-center">
                    <Button
                        as-link
                        label="Back to Search"
                        icon="pi pi-arrow-left"
                        severity="secondary"
                        outlined
                        size="large"
                        @click="backToSearch"
                    />
                </div>

                <!-- Support -->
                <!--
                <div class="mt-10 rounded-2xl bg-surface-100 p-6">
                    <h3 class="font-semibold text-surface-900">Need assistance?</h3>

                    <p class="mt-2 text-surface-600 leading-relaxed">
                        If you believe this is an error or your payment has already been charged,
                        please contact our support team and we'll be happy to help.
                    </p>

                    <Button
                        class="mt-5"
                        label="Contact Support"
                        icon="pi pi-envelope"
                        severity="help"
                        text
                    />
                </div>
            -->

                <!-- Error Reference -->
                <!--
                <div class="mt-8">
                    <p class="text-sm text-surface-500">Error Reference</p>

                    <p class="mt-2 font-mono text-lg font-semibold text-surface-900">
                        #ERR-20260720-07-21-0001
                    </p>

                    <p class="mt-2 text-sm text-surface-500">
                        Please include this reference when contacting support.
                    </p>
                </div>
            --></div>
        </div>
    </PublicLayout>
</template>
<script setup>
import PublicLayout from '@storefront/layouts/PublicLayout.vue'
import { Button } from 'primevue'
import { useRouter } from 'vue-router'

const router = useRouter()
const tryAgain = () => {
    // Retry booking / payment
}

const backToSearch = () => {
    router.push({ name: 'fleet' })
}
</script>
