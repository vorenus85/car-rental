<template>
    <div class="page-title card mb-4 shadow">
        <div class="page-title-container flex gap-3 items-center">
            <div v-if="slots.back" class="page-back">
                <slot name="back"></slot>
            </div>
            <div class="font-semibold text-xl">{{ title }}</div>
            <div
                v-if="slots.actions"
                class="page-title-actions flex justify-between items-center ml-auto"
            >
                <slot name="actions"></slot>
            </div>
        </div>

        <div v-if="slots.menu" class="page-menu mt-3 flex">
            <slot name="menu"></slot>
        </div>
    </div>
</template>
<script setup>
import { useSlots } from 'vue'

const slots = useSlots()

defineProps({
    title: {
        type: String,
        required: true,
    },
})
</script>
