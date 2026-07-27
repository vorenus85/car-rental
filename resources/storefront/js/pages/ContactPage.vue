<template>
    <PublicLayout>
        <section class="relative overflow-hidden">
            <ContactHero></ContactHero>
        </section>
        <section class="py-24 bg-slate-50">
            <ContactForm></ContactForm>
        </section>
        <section class="py-24 bg-slate-50">
            <ContactFaq></ContactFaq>
        </section>
        <section class="relative">
            <!-- Mobile card -->
            <div class="block lg:hidden px-5 pt-8 mb-10">
                <VisitOfficeCard />
            </div>

            <!-- Map -->
            <iframe
                title="Office Map"
                class="h-[520px] w-full grayscale-[15%]"
                loading="lazy"
                allowfullscreen
                referrerpolicy="no-referrer-when-downgrade"
                src="https://www.google.com/maps?q=Westend+City+Center,+1062+Budapest,+Váci+út+1-3&output=embed"
            >
            </iframe>

            <!-- Desktop card -->
            <div class="hidden lg:block absolute left-24 top-1/2 -translate-y-1/2">
                <VisitOfficeCard />
            </div>
        </section>
    </PublicLayout>
</template>
<script setup>
import PublicLayout from '@storefront/layouts/PublicLayout.vue'
import VisitOfficeCard from '@storefront/components/modules/Contact/VisitOfficeCard.vue'
import ContactFaq from '@storefront/components/modules/Contact/ContactFaq.vue'
import ContactForm from '@storefront/components/modules/Contact/ContactForm.vue'
import ContactHero from '@storefront/components/modules/Contact/ContactHero.vue'
</script>
