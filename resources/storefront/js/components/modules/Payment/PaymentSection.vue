<template>
    <div class="payment-section section rounded-xl border border-surface-200 bg-white p-6">
        <div class="section__header">
            <slot name="header" />
        </div>

        <Transition name="fade" mode="out-in">
            <div v-if="isOpen" class="section__body">
                <slot name="body" />
            </div>
        </Transition>
    </div>
</template>
<script setup>
defineProps({
    isOpen: {
        type: Boolean,
        default: false,
    },
})
</script>
