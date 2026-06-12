<template>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        :width="size"
        :height="size"
        viewBox="0 0 800 800"
        fill="none"
        stroke="currentColor"
        stroke-width="50"
        stroke-linecap="round"
        stroke-linejoin="round"
    >
        <path
            d="M200 66.667 100 200v466.667a66.667 66.667 0 0 0 66.667 66.667h466.667a66.667 66.667 0 0 0 66.667 -66.667V200l-100 -133.333Z"
        />
        <path d="M100 200h600" />
        <path d="M533.333 333.333a133.333 133.333 0 0 1 -266.667 0" />
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
