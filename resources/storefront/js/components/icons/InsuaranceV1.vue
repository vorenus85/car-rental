<template>
    <svg viewBox="0 0 800 800" fill="none" stroke="currentColor" :width="size" :height="size">
        <path
            stroke-linecap="round"
            stroke-width="50"
            stroke-linejoin="round"
            d="M400 125 175 200v175c0 147 94 279.68 225 325 131 -45.32 225 -178 225 -325V200z"
        />
        <path stroke-linecap="round" stroke-width="50" d="m325 400 50 50 100 -100" />
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
