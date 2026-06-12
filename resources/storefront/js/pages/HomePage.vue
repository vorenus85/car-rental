<script setup>
import PublicLayout from '@storefront/layouts/PublicLayout.vue'
import HeroBanner from '@storefront/components/modules/HeroBanner.vue'
import HomeAdvantages from '@storefront/components/modules/HomeAdvantages.vue'
import RandomCarsModule from '@storefront/components/modules/RandomCarsModule.vue'
</script>

<template>
    <PublicLayout>
        <HeroBanner></HeroBanner>
        <HomeAdvantages></HomeAdvantages>
        <RandomCarsModule></RandomCarsModule>
    </PublicLayout>
</template>
