<template>
    <div class="page-title">
        <h1 class="text-3xl mb-5 mt-2">{{ title }}</h1>
        <p v-if="subtitle" class="text-gray-600">{{ subtitle }}</p>
    </div>
</template>
<script setup>
defineProps({
    title: {
        type: String,
        default: null,
    },
    subtitle: {
        type: String,
        default: null,
    },
})
</script>
