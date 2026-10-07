<template>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 128 128"
        fill="none"
        :width="size"
        :height="size"
    >
        <g
            fill="none"
            stroke="currentColor"
            stroke-width="8"
            stroke-linecap="round"
            stroke-linejoin="round"
        >
            <rect x="28" y="30" width="72" height="74" rx="8" />
            <path d="M28 52h72" />

            <path d="M44 22v18" />
            <path d="M84 22v18" />

            <path d="M46 68h6" />
            <path d="M62 68h6" />
            <path d="M78 68h6" />

            <path d="M46 84h6" />
            <path d="M62 84h6" />
            <path d="M78 84h6" />
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
