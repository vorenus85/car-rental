<template>
    <p class="text-sm text-surface-600">{{ formatedDate }}, {{ formatedTime }} ({{ weekDay }})</p>
</template>
<script setup>
import { formatDate, getDayName, formatTime } from '@storefront/utils.js'
import { computed } from 'vue'

const props = defineProps({
    date: {
        type: String,
        default: null,
    },
})

const formatedDate = computed(() => {
    return formatDate(new Date(props.date), 'yyyy.MM.dd')
})

const formatedTime = computed(() => {
    return formatTime(new Date(props.date))
})

const weekDay = computed(() => {
    return getDayName(new Date(props.date))
})
</script>
