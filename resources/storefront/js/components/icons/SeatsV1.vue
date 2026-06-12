<template>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        :width="size"
        :height="size"
        viewBox="0 0 800 800"
        fill="none"
    >
        <path
            d="M556.2 187.5a156.233 156.233 0 1 1 -312.5 0 156.233 156.233 0 0 1 312.5 0"
            stroke="currentColor"
            stroke-width="50"
            stroke-miterlimit="10"
            stroke-linecap="round"
            stroke-linejoin="round"
        />
        <path
            d="M664.233 608.1a264.333 264.333 0 0 0 -528.733 0v42.467h146.2l118.167 118.2 118.2 -118.2h146.167z"
            stroke="currentColor"
            stroke-width="50"
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
