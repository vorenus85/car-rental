<template>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        :width="size"
        :height="size"
        viewBox="0 0 800 800"
        fill="none"
    >
        <path
            d="M285.714 342.857a128.571 128.571 0 1 0 0 -257.143A128.571 128.571 0 0 0 285.714 342.857"
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="50"
        />
        <path
            d="M542.857 771.429h-514.286v-57.143a257.143 257.143 0 1 1 514.286 0z"
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="50"
        />
        <path
            d="M514.286 85.714A128.571 128.571 0 0 1 514.286 342.857"
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="50"
        />
        <path
            d="M605.714 468a257.143 257.143 0 0 1 165.714 240v63.429H685.714"
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="50"
        />
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
