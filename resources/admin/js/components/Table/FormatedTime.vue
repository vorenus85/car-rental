<template>
    <span class="text-sm">{{ formatDateTime(date) }}</span>
</template>
<script setup>
defineProps({
    date: {
        type: String,
        default: null,
    },
})

const formatDateTime = date => {
    if (!date) return null

    const rawDate = new Date(date)

    return [
        String(rawDate.getHours()).padStart(2, '0'),
        String(rawDate.getMinutes()).padStart(2, '0'),
    ].join(':')
}
</script>
