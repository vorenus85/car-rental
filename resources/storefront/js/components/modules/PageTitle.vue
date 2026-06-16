<template>
    <h1 class="text-3xl mb-5 mt-2">{{ title }}</h1>
</template>
<script setup>
defineProps({
    title: {
        type: String,
        default: null,
    },
})
</script>
