<template>
    <div class="container mx-auto px-6">
        <div class="rounded-3xl bg-white border border-slate-200 shadow-xl p-8 lg:p-12">
            <!-- Header -->
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 mb-10">
                <div>
                    <h2 class="text-4xl font-extrabold text-[#061324]">
                        Frequently Asked Questions
                    </h2>

                    <p class="mt-3 text-slate-500">Find quick answers to common questions.</p>
                </div>

                <Button
                    as="a"
                    outlined
                    label="View All FAQs"
                    icon="pi pi-arrow-right"
                    icon-pos="right"
                    href="/faq"
                />
            </div>

            <!-- FAQ -->
            <div id="contact-accordion" class="grid lg:grid-cols-2 gap-5">
                <Accordion :multiple="true">
                    <AccordionPanel v-for="faq in leftFaqs" :key="faq.id" :value="faq.id">
                        <AccordionHeader>
                            {{ faq.question }}
                        </AccordionHeader>

                        <AccordionContent>
                            <p class="text-slate-600 leading-7">
                                {{ faq.answer }}
                            </p>
                        </AccordionContent>
                    </AccordionPanel>
                </Accordion>

                <Accordion :multiple="true">
                    <AccordionPanel v-for="faq in rightFaqs" :key="faq.id" :value="faq.id">
                        <AccordionHeader>
                            {{ faq.question }}
                        </AccordionHeader>

                        <AccordionContent>
                            <p class="text-slate-600 leading-7">
                                {{ faq.answer }}
                            </p>
                        </AccordionContent>
                    </AccordionPanel>
                </Accordion>
            </div>
        </div>
    </div>
</template>
<script setup>
import { Accordion, AccordionContent, AccordionHeader, AccordionPanel, Button } from 'primevue'

const leftFaqs = [
    {
        id: 1,
        question: 'What documents do I need to rent a car?',
        answer: "A valid driving licence, passport or ID card and a credit card in the main driver's name.",
    },

    {
        id: 2,
        question: 'Is there a mileage limit on rentals?',
        answer: 'Most rentals include unlimited mileage. Some special vehicles may have restrictions.',
    },

    {
        id: 3,
        question: 'Can I modify or cancel my reservation?',
        answer: 'Yes. Reservations can usually be modified or cancelled before pick-up.',
    },
]

const rightFaqs = [
    {
        id: 4,
        question: 'What payment methods do you accept?',
        answer: 'Visa, Mastercard and major debit cards are accepted.',
    },

    {
        id: 5,
        question: 'Is insurance included in the rental price?',
        answer: 'Basic insurance is included. Additional protection packages are available.',
    },

    {
        id: 6,
        question: 'Can I return the car to a different location?',
        answer: 'Yes, one-way rentals are available between selected locations.',
    },
]
</script>
<style>
#contact-accordion {
    .p-accordion {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

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
