<template>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        :width="size"
        :height="size"
        viewBox="0 0 64 64"
        fill="none"
    >
        <path
            d="M35.637 43.627c8.92 0.48 15.662 2.695 15.662 5.355 0 3.01 -8.64 5.452 -19.3 5.452 -10.658 0 -19.298 -2.441 -19.298 -5.452 0 -2.66 6.742 -4.875 15.662 -5.355"
            stroke="currentColor"
            stroke-width="4"
            stroke-miterlimit="10"
            stroke-linecap="round"
            stroke-linejoin="round"
        />
        <path
            d="M6.362 46.515c-2.844 1.562 -4.487 3.403 -4.487 5.375 0 5.653 13.488 10.235 30.125 10.235 16.638 0 30.125 -4.582 30.125 -10.235 0 -1.972 -1.643 -3.813 -4.487 -5.375"
            stroke="currentColor"
            stroke-width="4"
            stroke-miterlimit="10"
            stroke-linecap="round"
            stroke-linejoin="round"
        />
        <path
            d="M32 21.364a5.13 5.13 0 1 1 0 -10.261 5.13 5.13 0 0 1 0 10.26m0 -19.489c-8.59 0 -15.555 6.964 -15.555 15.555 0 5.965 8.716 20.975 13.1 28.146 1.122 1.837 3.789 1.837 4.912 0 4.383 -7.172 13.099 -22.181 13.099 -28.146C47.556 8.84 40.59 1.875 32 1.875"
            stroke="currentColor"
            stroke-width="4"
            stroke-miterlimit="10"
            stroke-linecap="round"
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
