<template>
    <section
        class="relative min-h-[500px] xl:min-h-[700px] lg:min-h-[600px] flex items-center hero-banner-module"
    >
        <!-- Background -->
        <div
            v-for="(image, index) in images"
            :key="image"
            class="absolute inset-0 bg-cover bg-center transition-opacity duration-[2000ms]"
            :class="{
                'opacity-100': currentImage === index,
                'opacity-0': currentImage !== index,
            }"
            :style="{
                backgroundImage: `url(${image})`,
            }"
        />

        <!-- Content -->
        <div class="relative z-10 max-w-8xl mx-auto px-4 w-full hero-banner-item">
            <div class="max-w-2xl text-white">
                <span
                    class="inline-block mb-4 text-primary-400 tracking-wider uppercase hero-banner-subtitle"
                >
                    Premium Car Rental
                </span>

                <h1
                    class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-6 hero-banner-title"
                >
                    Drive Your Journey.
                    <br />
                    <span class="color-primary">Your Way.</span>
                </h1>

                <p class="text-lg md:text-xl text-gray-200 mb-10 hero-banner-description">
                    Explore the world with comfort and style.<br />
                    Best cars. Best prices. Best experience.
                </p>

                <div class="mb-10 flex gap-4">
                    <div class="flex items-center gap-3 hero-advantages">
                        <CarV2 :size="30" class="hero-advantages-icon" />

                        <div>
                            <h3 class="font-semibold text-lg">Wide Selection</h3>

                            <p class="text-gray-300 text-sm">100+ cars available</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 hero-advantages">
                        <ValletV1 :size="30" class="hero-advantages-icon" />

                        <div>
                            <h3 class="font-semibold text-lg">Best Prices</h3>

                            <p class="text-gray-300 text-sm">No Hidden Fees</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 hero-advantages">
                        <CalendarV1 :size="30" class="hero-advantages-icon" />

                        <div>
                            <h3 class="font-semibold text-lg">Flexible Rental</h3>

                            <p class="text-gray-300 text-sm">Daily to Monthly</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import CarV2 from '@storefront/components/icons/CarV2.vue'
import ValletV1 from '@storefront/components/icons/ValletV1.vue'
import CalendarV1 from '@storefront/components/icons/CalendarV1.vue'
import { ref, onMounted, onUnmounted } from 'vue'

const images = [
    '/images/hero/banner_1_v2.webp',
    '/images/hero/banner_2_v2.webp',
    '/images/hero/banner_3_v2.webp',
]

const currentImage = ref(0)

let interval

onMounted(() => {
    interval = setInterval(() => {
        currentImage.value = (currentImage.value + 1) % images.length
    }, 5000)
})

onUnmounted(() => {
    clearInterval(interval)
})
</script>

<style scoped lang="scss">
.hero-banner-module {
    &:before {
        content: '';
        position: absolute;
        inset: 0;
        z-index: 1;
        pointer-events: none;

        background: linear-gradient(
            90deg,
            rgba(0, 0, 0, 0.75) 0%,
            rgba(0, 0, 0, 0.55) 35%,
            rgba(0, 0, 0, 0.25) 65%,
            rgba(0, 0, 0, 0) 100%
        );
    }
}

.hero-advantages-icon {
    color: var(--primary-color);
}

.hero-banner-subtitle {
    position: relative;
    padding-left: 20px;
    &:before {
        content: '';
        display: block;
        position: absolute;
        top: calc(50% - 2px);
        left: 0;
        width: 15px;
        height: 3px;
        background: var(--primary-color);
    }
}

.hero-banner-title {
    line-height: 1;
}
</style>
