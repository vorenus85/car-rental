<template>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        :width="size"
        :height="size"
        viewBox="0 0 800 800"
        fill="none"
    >
        <path
            d="M23.4 776.567V23.433h470.667L776.333 305.667v188.467a282.333 282.333 0 0 0 -282.333 282.333v0.1z"
            stroke="currentColor"
            stroke-width="50"
            stroke-miterlimit="10"
            stroke-linejoin="round"
        />
        <path
            d="M117.5 117.567h329.5l188.267 188.3H117.5z"
            stroke="currentColor"
            stroke-width="50"
            stroke-miterlimit="10"
            stroke-linejoin="round"
        />
        <path
            d="M211.667 494.133H117.467V400h188.267a94.133 94.133 0 0 1 -94.133 94.133Z"
            stroke="currentColor"
            stroke-width="50"
            stroke-miterlimit="10"
            stroke-linejoin="round"
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
