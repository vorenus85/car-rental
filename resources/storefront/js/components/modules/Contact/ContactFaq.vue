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
            <div id="contact-accordion">
                <Accordion :multiple="true" class="flex flex-col gap-5">
                    <AccordionPanel v-for="faq in contactFaqs" :key="faq.id" :value="faq.id">
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
import { contactFaqs } from '@storefront/data/faqs.js'
</script>
<style>
#contact-accordion {
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
