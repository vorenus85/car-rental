<template>
    <PublicLayout class="terms-and-conditions-page">
        <div class="mx-auto max-w-8xl px-4 py-4 min-h-[500px]">
            <BreadcrumbModule :items="breadcrumbItems"></BreadcrumbModule>
            <PageTitle title="Terms and Conditions"></PageTitle>

            <div class="mb-10">
                <p class="mt-2 text-sm text-slate-500">Last updated: July 21, 2026</p>
            </div>

            <div class="space-y-10 text-slate-700 leading-8">
                <section>
                    <h2 class="text-2xl font-semibold text-slate-900 mb-4">1. Introduction</h2>

                    <p>Welcome to <strong>DrivenGO</strong>.</p>

                    <p class="mt-3">
                        These Terms &amp; Conditions govern your use of this website and the
                        services provided through this demonstration application.
                    </p>

                    <p class="mt-3">
                        By accessing or using this website, you agree to be bound by these Terms
                        &amp; Conditions.
                    </p>
                </section>

                <section>
                    <h2 class="text-2xl font-semibold text-slate-900 mb-4">2. Portfolio Project</h2>

                    <p>
                        DrivenGO is a portfolio project created for educational and demonstration
                        purposes.
                    </p>

                    <p class="mt-3">
                        No real vehicle rentals, reservations, or financial transactions are
                        processed through this website.
                    </p>
                </section>

                <section>
                    <h2 class="text-2xl font-semibold text-slate-900 mb-4">3. Eligibility</h2>

                    <p>Users must be at least 18 years old to use this website.</p>

                    <p class="mt-3">
                        By using this website, you confirm that any information you provide is
                        accurate and complete.
                    </p>
                </section>

                <section>
                    <h2 class="text-2xl font-semibold text-slate-900 mb-4">
                        4. Booking Information
                    </h2>

                    <p>
                        Any booking information entered into this application is used solely for
                        demonstration purposes.
                    </p>

                    <p class="mt-3">
                        Reservations created within this website do not represent actual vehicle
                        rentals.
                    </p>
                </section>

                <section>
                    <h2 class="text-2xl font-semibold text-slate-900 mb-4">5. Payments</h2>

                    <p>
                        Any payment forms displayed on this website are intended only to demonstrate
                        the user interface.
                    </p>

                    <p class="mt-3">No real credit card information is processed or stored.</p>
                </section>

                <section>
                    <h2 class="text-2xl font-semibold text-slate-900 mb-4">
                        6. User Responsibilities
                    </h2>

                    <p>Users agree to:</p>

                    <ul class="list-disc ml-6 mt-3 space-y-2">
                        <li>Provide accurate information when testing the application.</li>
                        <li>Use fictitious personal and payment information.</li>
                        <li>Not attempt to interfere with the operation of the website.</li>
                        <li>Not use the website for unlawful purposes.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-2xl font-semibold text-slate-900 mb-4">
                        7. Intellectual Property
                    </h2>

                    <p>
                        All website content, including source code, graphics, layouts, icons, logos,
                        and design elements, is the intellectual property of the project author
                        unless otherwise stated.
                    </p>

                    <p class="mt-3">
                        Unauthorized copying, redistribution, or commercial use is prohibited.
                    </p>
                </section>

                <section>
                    <h2 class="text-2xl font-semibold text-slate-900 mb-4">
                        8. Limitation of Liability
                    </h2>

                    <p>
                        This website is provided on an "as is" basis without warranties of any kind.
                    </p>

                    <p class="mt-3">
                        The project author shall not be liable for any direct, indirect, incidental,
                        or consequential damages arising from the use of this website.
                    </p>
                </section>

                <section>
                    <h2 class="text-2xl font-semibold text-slate-900 mb-4">9. Privacy</h2>

                    <p>
                        Your use of this website is also governed by our Privacy Policy, which
                        explains how information may be collected and used.
                    </p>
                </section>

                <section>
                    <h2 class="text-2xl font-semibold text-slate-900 mb-4">
                        10. Third-Party Services
                    </h2>

                    <p>
                        This website may reference third-party services such as payment providers,
                        maps, or analytics tools.
                    </p>

                    <p class="mt-3">
                        We are not responsible for the content or privacy practices of those
                        external services.
                    </p>
                </section>

                <section>
                    <h2 class="text-2xl font-semibold text-slate-900 mb-4">
                        11. Changes to These Terms
                    </h2>

                    <p>We reserve the right to modify these Terms &amp; Conditions at any time.</p>

                    <p class="mt-3">
                        Changes become effective immediately upon publication on this page.
                    </p>
                </section>

                <section>
                    <h2 class="text-2xl font-semibold text-slate-900 mb-4">12. Contact</h2>

                    <p>
                        If you have any questions regarding these Terms &amp; Conditions, please
                        contact:
                    </p>

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
                        This application has been developed as a portfolio project to demonstrate
                        full-stack web development skills.
                    </p>

                    <p class="mt-3">
                        Vehicle information, bookings, prices, payment forms, and driver details
                        displayed throughout the application are for demonstration purposes only and
                        should not be considered real or legally binding.
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
        label: 'Terms and Conditions',
    },
]
</script>
