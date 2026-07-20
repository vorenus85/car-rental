<template>
    <div class="flex items-center justify-between py-4">
        <Button
            v-if="showBack"
            :label="backLabel"
            icon="pi pi-arrow-left"
            text
            severity="secondary"
            @click="$emit('back')"
        />

        <div v-else />

        <Button
            v-if="!hideNext"
            :label="nextLabel"
            icon="pi pi-arrow-right"
            icon-pos="right"
            :loading="loading"
            :disabled="disabled"
            class="min-w-52"
            size="large"
            @click="$emit('next')"
        />
    </div>
</template>

<script setup>
import Button from 'primevue/button'

defineProps({
    showBack: {
        type: Boolean,
        default: true,
    },
    hideNext: {
        type: Boolean,
        default: false,
    },
    backLabel: {
        type: String,
        default: 'Back',
    },
    nextLabel: {
        type: String,
        default: 'Continue',
    },
    loading: {
        type: Boolean,
        default: false,
    },
    disabled: {
        type: Boolean,
        default: false,
    },
})

defineEmits(['back', 'next'])
</script>
