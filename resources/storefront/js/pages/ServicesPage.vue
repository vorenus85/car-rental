<template>
    <PublicLayout>
        <section class="relative overflow-hidden">
            <ServicesHero></ServicesHero>
        </section>
        <ServiceBenefits></ServiceBenefits>
    </PublicLayout>
</template>
<script setup>
import PublicLayout from '@storefront/layouts/PublicLayout.vue'
import ServicesHero from '@storefront/components/modules/Services/ServicesHero.vue'
import ServiceBenefits from '@storefront/components/modules/Services/ServiceBenefits.vue'
</script>
