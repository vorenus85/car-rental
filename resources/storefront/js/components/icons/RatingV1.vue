<template>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        :width="size"
        :height="size"
        viewBox="0 0 800 800"
        fill="none"
    >
        <g clip-path="url(#clip0_1545_9236)">
            <path
                d="M392.57 542.86a257.14 257.14 0 1 0 0 -514.29 257.14 257.14 0 0 0 0 514.29"
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="57.14285714285715"
            />
            <path
                d="M392.57 400a114.29 114.29 0 1 0 0 -228.57 114.29 114.29 0 0 0 0 228.57"
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="57.14285714285715"
            />
            <path
                d="m342.86 538.29 -50.29 211.43a28.6 28.6 0 0 1 -14.86 18.86 30.9 30.9 0 0 1 -24.57 0L63.43 685.71a29.14 29.14 0 0 1 -10.29 -44.57L200 457.14"
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="57.14285714285715"
            />
            <path
                d="m457.14 535.43 51.43 214.29a28.6 28.6 0 0 0 15.43 18.86 28.6 28.6 0 0 0 24 0l188.57 -82.86a28.6 28.6 0 0 0 16 -20 27.4 27.4 0 0 0 -5.71 -24.57L593.72 446.29"
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="57.14285714285715"
            />
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
