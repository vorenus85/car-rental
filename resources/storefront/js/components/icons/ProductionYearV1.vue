<template>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        :width="size"
        :height="size"
        viewBox="0 0 800 800"
        fill="none"
    >
        <path
            d="M400 733.343c184.086 0 333.343 -149.257 333.343 -333.343S584.086 66.657 400 66.657 66.657 215.914 66.657 400 215.914 733.343 400 733.343"
            stroke="currentColor"
            stroke-width="50"
            stroke-linecap="round"
            stroke-linejoin="round"
        />
        <path
            d="M400 200v200l133.343 66.657"
            stroke="currentColor"
            stroke-width="50"
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
