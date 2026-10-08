<template>
    <div
        class="absolute inset-0 hidden bg-cover bg-center lg:block"
        :style="{ backgroundImage: `url('${image}')` }"
    >
        <div class="absolute inset-0 bg-white/05"></div>

        <div
            class="absolute inset-y-0 left-0 w-1/2 bg-gradient-to-r from-white/95 via-white/80 to-transparent"
        ></div>
    </div>

    <div class="relative z-10 container mx-auto px-6">
        <div class="flex min-h-[320px] items-center">
            <div class="max-w-xl">
                <BreadcrumbModule :items="breadcrumbItems"></BreadcrumbModule>
                <PageTitle :title="title"></PageTitle>
                <p class="mt-6 max-w-lg text-lg leading-8">
                    {{ intro }}
                </p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue'
import BreadcrumbModule from '@storefront/components/modules/BreadcrumbModule.vue'
import PageTitle from '@storefront/components/modules/PageTitle.vue'

const props = defineProps({
    title: {
        type: String,
        required: true,
    },
    intro: {
        type: String,
        required: true,
    },
    image: {
        type: String,
        required: true,
    },
})

const breadcrumbItems = computed(() => [
    {
        label: 'Services',
        route: '/services',
    },
    {
        label: props.title,
    },
])
</script>
