<template>
    <!-- Background image -->
    <div
        class="absolute inset-0 bg-cover bg-center"
        style="background-image: url('/images/services_hero.webp')"
    >
        <div class="absolute inset-0 bg-white/05"></div>

        <div
            class="absolute inset-y-0 left-0 w-1/2 bg-gradient-to-r from-white/95 via-white/80 to-transparent"
        ></div>
    </div>

    <!-- Content -->
    <div class="relative z-10 container mx-auto px-6">
        <div class="flex min-h-[320px] items-center">
            <div class="max-w-xl">
                <BreadcrumbModule :items="breadcrumbItems"></BreadcrumbModule>
                <PageTitle title="Our Services"></PageTitle>
                <p class="mt-6 text-lg leading-8 max-w-lg">
                    Everything you need for a perfect car rental experience. Choose from our premium
                    services, insurance options and useful extras.
                </p>
            </div>
        </div>
    </div>
</template>
<script setup>
import BreadcrumbModule from '@storefront/components/modules/BreadcrumbModule.vue'
import PageTitle from '@storefront/components/modules/PageTitle.vue'

const breadcrumbItems = [
    {
        label: 'Services',
    },
]
</script>
