<template>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128" :width="size" :height="size">
        <g
            fill="none"
            stroke="currentColor"
            stroke-width="8"
            stroke-linecap="round"
            stroke-linejoin="round"
        >
            <path d="M32 68v-8c0-18 14-34 32-34s32 16 32 34v8" />

            <rect x="22" y="64" width="18" height="28" rx="6" />
            <rect x="88" y="64" width="18" height="28" rx="6" />

            <path d="M96 92v6c0 8-6 14-14 14H70" />
            <path d="M70 112h-8" />
        </g>
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
