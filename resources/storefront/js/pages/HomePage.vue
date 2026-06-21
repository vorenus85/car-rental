<script setup>
import PublicLayout from '@storefront/layouts/PublicLayout.vue'
import HeroBanner from '@storefront/components/modules/HeroBanner.vue'
import HomeAdvantages from '@storefront/components/modules/HomeAdvantages.vue'
import CarSearchPanel from '@storefront/components/modules/CarSearchPanel.vue'
import CarsModule from '@storefront/components/modules/CarsModule.vue'

import { useCars } from '@storefront/composables/useCars.js'
import { onMounted } from 'vue'
const { getRandomCars, loadingCars, cars } = useCars()

onMounted(async () => {
    await getRandomCars()
})
</script>

<template>
    <PublicLayout>
        <HeroBanner></HeroBanner>
        <CarSearchPanel></CarSearchPanel>
        <HomeAdvantages></HomeAdvantages>
        <div class="background-white pt-3">
            <CarsModule
                :cars="cars"
                :loading-cars="loadingCars"
                title="Explore Our Fleet"
            ></CarsModule>
        </div>
    </PublicLayout>
</template>
