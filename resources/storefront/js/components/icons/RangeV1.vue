<template>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 800 800"
        fill="none"
        stroke="currentColor"
        stroke-width="50"
        stroke-linecap="round"
        stroke-linejoin="round"
        :width="size"
        :height="size"
    >
        <circle cx="400" cy="400" r="280" />
        <path d="M520 280L460 460L280 520L340 340L520 280Z" />
        <circle cx="400" cy="400" r="30" />
    </svg>
</template>
<script setup>
defineProps({
    size: {
        type: Number,
        default: 24,
    },
})
</script>
