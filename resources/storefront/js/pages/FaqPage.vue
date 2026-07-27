<template>
    <PublicLayout class="faq-page">
        <div class="mx-auto max-w-8xl px-4 py-4 min-h-[500px]">
            <BreadcrumbModule :items="breadcrumbItems"></BreadcrumbModule>
            <PageTitle title="Frequently Asked Questions"></PageTitle>
            <div class="mb-10">
                <p class="mt-2 text-sm text-slate-500">Last updated: July 27, 2026</p>
            </div>
            <div class="space-y-10 text-slate-700 leading-8">
                <section class="mb-20">
                    <h2 class="text-2xl mb-5 mt-2">Booking Questions</h2>
                    <div id="booking-faq-accordion">
                        <Accordion class="flex flex-col gap-5">
                            <AccordionPanel
                                v-for="(item, index) in bookingFaq"
                                :key="index"
                                :value="index"
                            >
                                <AccordionHeader>
                                    <h3>{{ item.question }}</h3>
                                </AccordionHeader>

                                <AccordionContent>
                                    <div
                                        class="prose prose-sm max-w-none text-surface-600 dark:text-surface-300"
                                    >
                                        {{ item.answer }}
                                    </div>
                                </AccordionContent>
                            </AccordionPanel>
                        </Accordion>
                    </div>
                </section>
                <section class="mb-20">
                    <h2 class="text-2xl mb-5 mt-2">Driver Requirements Questions</h2>
                    <div id="driver-requirements-faq-accordion">
                        <Accordion class="flex flex-col gap-5">
                            <AccordionPanel
                                v-for="(item, index) in driverRequirementsFaq"
                                :key="index"
                                :value="index"
                            >
                                <AccordionHeader>
                                    <h3>{{ item.question }}</h3>
                                </AccordionHeader>

                                <AccordionContent>
                                    <div
                                        class="prose prose-sm max-w-none text-surface-600 dark:text-surface-300"
                                    >
                                        {{ item.answer }}
                                    </div>
                                </AccordionContent>
                            </AccordionPanel>
                        </Accordion>
                    </div>
                </section>
                <section class="mb-20">
                    <h2 class="text-2xl mb-5 mt-2">Payment Questions</h2>
                    <div id="payment-faq-accordion">
                        <Accordion class="flex flex-col gap-5">
                            <AccordionPanel
                                v-for="(item, index) in paymentsFaq"
                                :key="index"
                                :value="index"
                            >
                                <AccordionHeader>
                                    <h3>{{ item.question }}</h3>
                                </AccordionHeader>

                                <AccordionContent>
                                    <div
                                        class="prose prose-sm max-w-none text-surface-600 dark:text-surface-300"
                                    >
                                        {{ item.answer }}
                                    </div>
                                </AccordionContent>
                            </AccordionPanel>
                        </Accordion>
                    </div>
                </section>

                <section class="mb-20">
                    <h2 class="text-2xl mb-5 mt-2">Vehicle Pickup & Return Questions</h2>
                    <div id="vehicle-pickup-and-return-faq-accordion">
                        <Accordion class="flex flex-col gap-5">
                            <AccordionPanel
                                v-for="(item, index) in pickupReturnFaq"
                                :key="index"
                                :value="index"
                            >
                                <AccordionHeader>
                                    <h3>{{ item.question }}</h3>
                                </AccordionHeader>

                                <AccordionContent>
                                    <div
                                        class="prose prose-sm max-w-none text-surface-600 dark:text-surface-300"
                                    >
                                        {{ item.answer }}
                                    </div>
                                </AccordionContent>
                            </AccordionPanel>
                        </Accordion>
                    </div>
                </section>

                <section class="mb-20">
                    <h2 class="text-2xl mb-5 mt-2">Insurance Questions</h2>
                    <div id="insurance-faq-accordion">
                        <Accordion class="flex flex-col gap-5">
                            <AccordionPanel
                                v-for="(item, index) in insuranceFaq"
                                :key="index"
                                :value="index"
                            >
                                <AccordionHeader>
                                    <h3>{{ item.question }}</h3>
                                </AccordionHeader>

                                <AccordionContent>
                                    <div
                                        class="prose prose-sm max-w-none text-surface-600 dark:text-surface-300"
                                    >
                                        {{ item.answer }}
                                    </div>
                                </AccordionContent>
                            </AccordionPanel>
                        </Accordion>
                    </div>
                </section>

                <section class="mb-20">
                    <h2 class="text-2xl mb-5 mt-2">Extras Questions</h2>
                    <div id="extras-faq-accordion">
                        <Accordion class="flex flex-col gap-5">
                            <AccordionPanel
                                v-for="(item, index) in extrasFaq"
                                :key="index"
                                :value="index"
                            >
                                <AccordionHeader>
                                    <h3>{{ item.question }}</h3>
                                </AccordionHeader>

                                <AccordionContent>
                                    <div
                                        class="prose prose-sm max-w-none text-surface-600 dark:text-surface-300"
                                    >
                                        {{ item.answer }}
                                    </div>
                                </AccordionContent>
                            </AccordionPanel>
                        </Accordion>
                    </div>
                </section>

                <section class="mb-20">
                    <h2 class="text-2xl mb-5 mt-2">Rental Policies Questions</h2>
                    <div id="rental-policies-faq-accordion">
                        <Accordion class="flex flex-col gap-5">
                            <AccordionPanel
                                v-for="(item, index) in rentalPoliciesFaq"
                                :key="index"
                                :value="index"
                            >
                                <AccordionHeader>
                                    <h3>{{ item.question }}</h3>
                                </AccordionHeader>

                                <AccordionContent>
                                    <div
                                        class="prose prose-sm max-w-none text-surface-600 dark:text-surface-300"
                                    >
                                        {{ item.answer }}
                                    </div>
                                </AccordionContent>
                            </AccordionPanel>
                        </Accordion>
                    </div>
                </section>
                <section class="rounded-xl border-l-4 border-amber-500 bg-amber-50 p-6 mb-5">
                    <h2 class="text-xl font-semibold text-slate-900 mb-3">
                        Portfolio Project Notice
                    </h2>

                    <p>
                        This Frequently Asked Questions page is part of a demonstration car rental
                        application created for portfolio purposes.
                    </p>
                    <p class="mt-3">
                        All questions, answers, booking policies, payment information, insurance
                        coverage, rental requirements, and vehicle-related details presented on this
                        page are fictional examples created solely to demonstrate the functionality,
                        content structure, and user experience of a production-ready car rental
                        platform. They do not represent the policies or services of a real car
                        rental company.
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
import { Accordion, AccordionContent, AccordionHeader, AccordionPanel } from 'primevue'
import {
    bookingFaq,
    driverRequirementsFaq,
    paymentsFaq,
    pickupReturnFaq,
    insuranceFaq,
    extrasFaq,
    rentalPoliciesFaq,
} from '@storefront/data/faqs.js'

const breadcrumbItems = [
    {
        label: 'Frequently Asked Questions',
    },
]
</script>
<style>
.faq-page {
    .p-accordionpanel {
        border: 1px solid rgb(226 232 240);

        border-radius: 14px;

        overflow: hidden;

        background: white;

        transition: 0.2s;
    }

    .p-accordionpanel:hover {
        border-color: #fcb102;
    }

    .p-accordionheader {
        padding: 1rem 1.25rem;

        font-weight: 600;

        color: #061324;
    }

    .p-accordioncontent-content {
        padding: 0 1.25rem 1.25rem;

        color: rgb(71 85 105);

        line-height: 1.8;
    }
}
</style>
