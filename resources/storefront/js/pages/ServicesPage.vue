<template>
    <PublicLayout>
        <section class="relative overflow-hidden">
            <ServicesHero></ServicesHero>
        </section>
        <ServiceBenefits class="mb-10"></ServiceBenefits>
        <section class="relative z-10 px-4">
            <div class="container mx-auto px-6 py-7">
                <h2
                    class="relative inline-block text-2xl font-bold leading-tight text-slate-950 after:absolute after:left-0 after:-bottom-2 after:h-1 after:w-16 after:bg-primary"
                >
                    Services for Your Journey
                </h2>
                <ServicesList></ServicesList>
            </div>
        </section>
        <section class="relative z-10 px-4">
            <div class="container mx-auto px-6 py-7">
                <InsuranceOptions></InsuranceOptions>
            </div>
        </section>
        <section class="relative z-10 px-4">
            <div class="container mx-auto px-6 py-7">
                <ServiceFleetCTA></ServiceFleetCTA>
            </div>
        </section>
    </PublicLayout>
</template>
<script setup>
import PublicLayout from '@storefront/layouts/PublicLayout.vue'
import ServicesHero from '@storefront/components/modules/Services/ServicesHero.vue'
import ServiceBenefits from '@storefront/components/modules/Services/ServiceBenefits.vue'
import ServicesList from '@storefront/components/modules/Services/ServicesList.vue'
import ServiceFleetCTA from '@storefront/components/modules/Services/ServiceFleetCTA.vue'
import InsuranceOptions from '@storefront/components/modules/Services/InsuranceOptions.vue'
</script>
