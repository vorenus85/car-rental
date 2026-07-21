<template>
    <PublicLayout class="cookie-policy-page">
        <div class="mx-auto max-w-8xl px-4 py-4 min-h-[500px]">
            <BreadcrumbModule :items="breadcrumbItems"></BreadcrumbModule>
            <PageTitle title="Refund & Cancellation Policy"></PageTitle>

            <div class="mb-10">
                <p class="mt-2 text-sm text-slate-500">Last updated: July 21, 2026</p>
            </div>

            <div class="space-y-10 text-slate-700 leading-8">
                <section>
                    <h2 class="text-2xl font-semibold text-slate-900 mb-4">1. Introduction</h2>

                    <p>
                        This Refund &amp; Cancellation Policy explains how cancellations, refunds,
                        and booking modifications would be handled when using the DrivenGO car
                        rental platform.
                    </p>

                    <p class="mt-3">
                        DrivenGO is a portfolio project created for educational and demonstration
                        purposes. No real bookings or payments are processed through this website.
                    </p>
                </section>

                <section>
                    <h2 class="text-2xl font-semibold text-slate-900 mb-4">
                        2. Booking Cancellation
                    </h2>

                    <p>
                        Customers may cancel a booking at any time before the scheduled vehicle
                        pickup.
                    </p>

                    <ul class="list-disc ml-6 mt-3 space-y-2">
                        <li>
                            Cancellations made more than 48 hours before pickup would normally
                            qualify for a full refund.
                        </li>
                        <li>
                            Cancellations made within 48 hours of pickup may be subject to
                            cancellation fees.
                        </li>
                        <li>No refunds would normally be provided for no-show reservations.</li>
                    </ul>

                    <p class="mt-4">These rules are presented solely for demonstration purposes.</p>
                </section>

                <section>
                    <h2 class="text-2xl font-semibold text-slate-900 mb-4">3. Refund Policy</h2>

                    <p>
                        If a booking qualifies for a refund, the amount would normally be returned
                        using the original payment method.
                    </p>

                    <p class="mt-3">
                        Typical refund processing times may vary depending on the payment provider
                        and financial institution.
                    </p>

                    <ul class="list-disc ml-6 mt-3 space-y-2">
                        <li>Full refund for eligible cancellations.</li>
                        <li>Partial refund when cancellation fees apply.</li>
                        <li>No refund for completed rentals or no-show bookings.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-2xl font-semibold text-slate-900 mb-4">
                        4. Booking Modifications
                    </h2>

                    <p>Customers may request changes to their reservation, including:</p>

                    <ul class="list-disc ml-6 mt-3 space-y-2">
                        <li>Pickup date and time.</li>
                        <li>Return date and time.</li>
                        <li>Pickup or drop-off location.</li>
                        <li>Selected vehicle category.</li>
                        <li>Optional extras.</li>
                    </ul>

                    <p class="mt-4">
                        Availability and pricing may change when a reservation is modified.
                    </p>
                </section>

                <section>
                    <h2 class="text-2xl font-semibold text-slate-900 mb-4">5. No-Show Policy</h2>

                    <p>
                        A reservation may be considered a "No-Show" if the customer does not collect
                        the vehicle within the agreed pickup period and fails to notify the rental
                        provider.
                    </p>

                    <p class="mt-3">
                        In a real-world rental service, no-show reservations are generally
                        non-refundable.
                    </p>
                </section>

                <section>
                    <h2 class="text-2xl font-semibold text-slate-900 mb-4">
                        6. Exceptional Circumstances
                    </h2>

                    <p>
                        Refunds or booking changes may be considered in exceptional situations,
                        including:
                    </p>

                    <ul class="list-disc ml-6 mt-3 space-y-2">
                        <li>Vehicle unavailable.</li>
                        <li>Technical issues affecting the booking.</li>
                        <li>Unexpected operational circumstances.</li>
                        <li>Force majeure events.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-2xl font-semibold text-slate-900 mb-4">
                        7. Payment Processing
                    </h2>

                    <p>DrivenGO does not process or store real payment information.</p>

                    <p class="mt-3">
                        Any payment forms shown throughout the application are provided solely to
                        demonstrate the booking workflow.
                    </p>
                </section>

                <section>
                    <h2 class="text-2xl font-semibold text-slate-900 mb-4">
                        8. Changes to This Policy
                    </h2>

                    <p>
                        We reserve the right to modify this Refund &amp; Cancellation Policy at any
                        time.
                    </p>

                    <p class="mt-3">
                        Any changes will become effective immediately after being published on this
                        page.
                    </p>
                </section>

                <section>
                    <h2 class="text-2xl font-semibold text-slate-900 mb-4">9. Contact</h2>

                    <p>If you have any questions regarding this policy, please contact:</p>

                    <div class="mt-4 rounded-lg border border-slate-200 bg-slate-50 p-5">
                        <p class="font-medium">DrivenGO</p>
                        <p>Email: janos.perge@gmail.com</p>
                    </div>
                </section>

                <section class="rounded-xl border-l-4 border-amber-500 bg-amber-50 p-6 mb-5">
                    <h2 class="text-xl font-semibold text-slate-900 mb-3">
                        Portfolio Project Notice
                    </h2>

                    <p>
                        This Refund &amp; Cancellation Policy is provided as part of a demonstration
                        application created for portfolio purposes.
                    </p>

                    <p class="mt-3">
                        All bookings, payments, cancellations, and refund scenarios described
                        throughout this application are fictional and exist solely to demonstrate
                        the functionality of a production-ready car rental platform.
                    </p>
                </section>
            </div>
        </div>
    </PublicLayout>
</template>
<script setup>
import PublicLayout from '@storefront/layouts/PublicLayout.vue'
import PageTitle from '@storefront/components/modules/PageTitle.vue'
import BreadcrumbModule from '@storefront/components/modules/BreadcrumbModule.vue'

const breadcrumbItems = [
    {
        label: 'Refund & Cancellation Policy',
    },
]
</script>
