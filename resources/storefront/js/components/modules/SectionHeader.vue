<template>
    <div class="flex flex-col">
        <h2 class="text-2xl font-semibold text-surface-900">{{ title }}</h2>

        <p class="mt-1 text-sm text-surface-500">
            {{ subTitle }}
        </p>
    </div>
</template>
<script setup>
defineProps({
    title: {
        type: String,
        default: 'Header title',
    },
    subTitle: {
        type: String,
        default: 'Sub title',
    },
})
</script>
