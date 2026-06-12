<template>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        :width="size"
        :height="size"
        viewBox="0 0 800 800"
        fill="none"
    >
        <path
            d="M643.638 212.45V149.875a62.425 62.425 0 0 0 -62.425 -62.425H93.625a62.5 62.5 0 0 0 0 125h612.575a62.425 62.425 0 0 1 62.425 62.425v93.825"
            stroke="currentColor"
            stroke-width="50"
            stroke-miterlimit="10"
        />
        <path
            d="M768.638 556.2V650a62.425 62.425 0 0 1 -62.425 62.438H93.625a62.5 62.5 0 0 1 -62.5 -62.5v-500"
            stroke="currentColor"
            stroke-width="50"
            stroke-miterlimit="10"
        />
        <path
            d="M768.638 556.2h-156.25a93.75 93.75 0 0 1 0 -187.5h156.25z"
            stroke="currentColor"
            stroke-width="50"
            stroke-miterlimit="10"
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
