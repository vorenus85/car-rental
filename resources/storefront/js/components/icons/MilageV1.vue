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
        <path d="M40 560a360 360 0 1 1 720 0" />

        <path d="M400 560 580 380" />

        <path d="M460 560A60 60 0 0 1 400 620A60 60 0 0 1 340 560A60 60 0 0 1 460 560z" />

        <path d="M180 340h.4" />
        <path d="M400 250h.4" />
        <path d="M620 340h.4" />
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
