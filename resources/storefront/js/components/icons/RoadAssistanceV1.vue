<template>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 800 800"
        fill="none"
        stroke="currentColor"
        :width="size"
        :height="size"
    >
        <path
            stroke-width="50"
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M133.333 666.667c66.667 -200 150 -400 233.333 -533.333"
        />
        <path
            stroke-width="50"
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M666.667 666.667c-66.667 -200 -150 -400 -233.333 -533.333"
        />
        <path stroke-linecap="round" d="M400 600v-50" stroke-width="50" />
        <path stroke-linecap="round" d="M400 433.333v-50" stroke-width="50" />
        <path stroke-width="50" stroke-linecap="round" d="M400 266.667V233.333" />
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
