<template>
    <Tag size="small" severity="secondary no-wrap">€ {{ price }}</Tag>
</template>
<script setup>
import { Tag } from 'primevue'

defineProps({
    price: {
        type: Number,
        default: null,
    },
})
</script>
