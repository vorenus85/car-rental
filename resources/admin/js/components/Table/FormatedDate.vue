<template>
    <span class="font-medium">{{ formatDate(date) }}</span>
</template>
<script setup>
defineProps({
    date: {
        type: String,
        default: null,
    },
})

const formatDate = date => {
    if (!date) return null

    const rawDate = new Date(date)

    return [
        rawDate.getFullYear(),
        String(rawDate.getMonth() + 1).padStart(2, '0'),
        String(rawDate.getDate()).padStart(2, '0'),
    ].join('.')
}
</script>
