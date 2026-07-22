<template>
    <PublicLayout class="terms-and-conditions-page">
        <div class="mx-auto max-w-8xl px-4 py-4 min-h-[500px]">
            <BreadcrumbModule :items="breadcrumbItems"></BreadcrumbModule>
            <PageTitle title="Rental Requirements"></PageTitle>
            <div class="mb-10">
                <p class="mt-2 text-sm text-slate-500">Last updated: July 21, 2026</p>
            </div>

            <section>
                <div class="">
                    <!-- Header -->
                    <div class="mb-10">
                        <p class="mt-4 text-lg leading-8 text-slate-600">
                            To ensure a safe, transparent, and hassle-free rental experience, please
                            review the following requirements before confirming your reservation.
                            These conditions apply to all standard vehicle rentals and are designed
                            to protect both our customers and our fleet.
                        </p>
                    </div>

                    <div class="mb-10">
                        <h2 class="text-lg font-semibold text-slate-900">Minimum Driver Age</h2>

                        <p class="mt-2 leading-7 text-slate-600">
                            Drivers must be at least <strong>25 years old</strong> to rent a
                            vehicle. This age requirement helps ensure compliance with our insurance
                            policies and provides a safe driving experience for all customers.
                        </p>
                    </div>

                    <div class="mb-10">
                        <h2 class="text-lg font-semibold text-slate-900">Valid Driver's License</h2>

                        <p class="mt-2 leading-7 text-slate-600">
                            All drivers must hold a valid driver's license that has been issued for
                            at least <strong>two years</strong>. The license must remain valid
                            throughout the entire rental period and be presented when collecting the
                            vehicle.
                        </p>
                    </div>

                    <div class="mb-10">
                        <h2 class="text-lg font-semibold text-slate-900">Unlimited Mileage</h2>

                        <p class="mt-2 leading-7 text-slate-600">
                            Every rental includes <strong>unlimited mileage</strong>, allowing you
                            to travel without worrying about distance limits or additional mileage
                            charges. Enjoy the freedom to explore your destination at your own pace.
                        </p>
                    </div>

                    <div class="mb-10">
                        <h2 class="text-lg font-semibold text-slate-900">
                            Basic Insurance Included
                        </h2>

                        <p class="mt-2 leading-7 text-slate-600">
                            Basic insurance coverage is included in the rental price, giving you
                            peace of mind during your journey. Additional protection packages and
                            optional coverage can also be selected during the booking process.
                        </p>
                    </div>

                    <div class="mb-10">
                        <h2 class="text-lg font-semibold text-slate-900">
                            Refundable Security Deposit
                        </h2>

                        <p class="mt-2 leading-7 text-slate-600">
                            A refundable security deposit may be required when collecting your
                            vehicle. The deposit is securely held for the duration of the rental and
                            is fully refunded after the vehicle is returned in accordance with the
                            rental agreement.
                        </p>
                    </div>

                    <div class="mb-10">
                        <h2 class="text-lg font-semibold text-slate-900">Fuel Policy</h2>

                        <p class="mt-2 leading-7 text-slate-600">
                            Vehicles must be returned with the <strong>same fuel level</strong> as
                            when they were collected. Returning a vehicle with less fuel may result
                            in additional refueling charges as outlined in the rental agreement.
                        </p>
                    </div>

                    <div class="mb-10">
                        <h2 class="text-lg font-semibold text-slate-900">Free Cancellation</h2>

                        <p class="mt-2 leading-7 text-slate-600">
                            Plans can change, which is why we offer
                            <strong
                                >free cancellation up to 48 hours before your scheduled
                                pick-up</strong
                            >. Cancellations made after this period may be subject to our
                            cancellation policy and applicable fees.
                        </p>
                    </div>

                    <div class="mb-10">
                        <h2 class="text-lg font-semibold text-slate-900">Additional Drivers</h2>

                        <p class="mt-2 leading-7 text-slate-600">
                            Additional drivers may be added to your rental agreement for an extra
                            fee. Every additional driver must meet the same age and licensing
                            requirements as the primary driver and must be registered before driving
                            the vehicle.
                        </p>
                    </div>
                </div>
            </section>
        </div></PublicLayout
    >
</template>
<script setup>
import PublicLayout from '@storefront/layouts/PublicLayout.vue'
import PageTitle from '@storefront/components/modules/PageTitle.vue'
import BreadcrumbModule from '@storefront/components/modules/BreadcrumbModule.vue'

const breadcrumbItems = [
    {
        label: 'Rental Requirements',
    },
]
</script>
