<template>
    <div class="page-title card mb-4 shadow flex justify-between items-center">
        <div class="font-semibold text-xl">{{ title }}</div>
        <div class="page-title-actions flex justify-between items-center gap-3">
            <slot name="actions"></slot>
        </div>
    </div>
</template>
<script setup>
defineProps({
    title: {
        type: String,
        required: true,
    },
})
</script>
