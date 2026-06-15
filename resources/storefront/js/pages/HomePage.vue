<script setup>
import PublicLayout from '@storefront/layouts/PublicLayout.vue'
import HeroBanner from '@storefront/components/modules/HeroBanner.vue'
import HomeAdvantages from '@storefront/components/modules/HomeAdvantages.vue'
import RandomCarsModule from '@storefront/components/modules/RandomCarsModule.vue'
import CarSearchPanel from '@storefront/components/modules/CarSearchPanel.vue'
</script>

<template>
    <PublicLayout>
        <HeroBanner></HeroBanner>
        <CarSearchPanel></CarSearchPanel>
        <HomeAdvantages></HomeAdvantages>
        <div class="background-white pt-3">
            <RandomCarsModule></RandomCarsModule>
        </div>
    </PublicLayout>
</template>
