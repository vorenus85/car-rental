<template>
    <PublicLayout class="cookie-policy-page">
        <div class="mx-auto max-w-8xl px-4 py-4 min-h-[500px]">
            <BreadcrumbModule :items="breadcrumbItems"></BreadcrumbModule>
            <PageTitle title="Cookie Policy"></PageTitle>

            <div class="mb-10">
                <p class="mt-2 text-sm text-slate-500">Last updated: July 21, 2026</p>
            </div>

            <div class="space-y-10 text-slate-700 leading-8">
                <section>
                    <h2 class="text-2xl font-semibold text-slate-900 mb-4">1. What Are Cookies?</h2>

                    <p>
                        Cookies are small text files that are stored on your device when you visit a
                        website. They help websites function correctly, remember your preferences,
                        and improve your browsing experience.
                    </p>
                </section>

                <section>
                    <h2 class="text-2xl font-semibold text-slate-900 mb-4">
                        2. How We Use Cookies
                    </h2>

                    <p>
                        DrivenGO uses cookies to provide a smooth and secure experience while using
                        our car rental platform.
                    </p>

                    <p class="mt-3">Cookies may be used to:</p>

                    <ul class="list-disc ml-6 mt-3 space-y-2">
                        <li>Maintain your browsing session.</li>
                        <li>Remember your preferences.</li>
                        <li>Improve website performance.</li>
                        <li>Enhance website security.</li>
                        <li>Analyze website usage.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-2xl font-semibold text-slate-900 mb-4">
                        3. Types of Cookies We Use
                    </h2>

                    <h3 class="text-lg font-semibold mb-2">Essential Cookies</h3>

                    <p>
                        These cookies are necessary for the website to function properly. They
                        enable features such as user sessions, security protection, and the booking
                        process.
                    </p>

                    <h3 class="text-lg font-semibold mt-6 mb-2">Functional Cookies</h3>

                    <p>
                        Functional cookies remember your preferences, including selected language,
                        pickup location, booking details, and other settings to improve your
                        experience.
                    </p>

                    <h3 class="text-lg font-semibold mt-6 mb-2">Analytics Cookies</h3>

                    <p>
                        Analytics cookies help us understand how visitors interact with the website.
                        They collect anonymous information such as page views, session duration, and
                        browser type.
                    </p>

                    <h3 class="text-lg font-semibold mt-6 mb-2">Performance Cookies</h3>

                    <p>
                        These cookies collect anonymous performance information that helps us
                        improve the speed, stability, and usability of the website.
                    </p>
                </section>

                <section>
                    <h2 class="text-2xl font-semibold text-slate-900 mb-4">
                        4. Third-Party Cookies
                    </h2>

                    <p>
                        Our website may use third-party services that place their own cookies on
                        your device.
                    </p>

                    <p class="mt-3">These services may include:</p>

                    <ul class="list-disc ml-6 mt-3 space-y-2">
                        <li>Google Maps</li>
                        <li>Payment providers</li>
                        <li>Analytics services</li>
                    </ul>

                    <p class="mt-4">
                        These third-party providers operate under their own privacy and cookie
                        policies.
                    </p>
                </section>

                <section>
                    <h2 class="text-2xl font-semibold text-slate-900 mb-4">5. Managing Cookies</h2>

                    <p>Most web browsers allow you to control how cookies are handled. You can:</p>

                    <ul class="list-disc ml-6 mt-3 space-y-2">
                        <li>View stored cookies.</li>
                        <li>Delete existing cookies.</li>
                        <li>Block all cookies.</li>
                        <li>Block third-party cookies.</li>
                        <li>Receive notifications before cookies are stored.</li>
                    </ul>

                    <p class="mt-4">
                        Please note that disabling essential cookies may affect the functionality of
                        this website.
                    </p>
                </section>

                <section>
                    <h2 class="text-2xl font-semibold text-slate-900 mb-4">6. Cookie Consent</h2>

                    <p>
                        When you first visit our website, you may be asked to accept or manage your
                        cookie preferences through a cookie banner.
                    </p>

                    <p class="mt-3">
                        Your preferences can be changed at any time through your browser settings.
                    </p>
                </section>

                <section>
                    <h2 class="text-2xl font-semibold text-slate-900 mb-4">
                        7. Changes to This Cookie Policy
                    </h2>

                    <p>We may update this Cookie Policy from time to time.</p>

                    <p class="mt-3">
                        Any updates will be published on this page with a revised "Last updated"
                        date.
                    </p>
                </section>

                <section>
                    <h2 class="text-2xl font-semibold text-slate-900 mb-4">8. Contact</h2>

                    <p>
                        If you have any questions regarding this Cookie Policy, please contact us:
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
                        DrivenGO is a demonstration project created for educational and portfolio
                        purposes.
                    </p>

                    <p class="mt-3">
                        References to cookies, analytics services, payment providers, maps, and
                        other third-party technologies are included to demonstrate how a
                        production-ready car rental application would operate. Some of these
                        services may not be active within this demonstration environment.
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
        label: 'Cookie Policy',
    },
]
</script>
