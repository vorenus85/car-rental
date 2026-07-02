<template>
    <div
        class="flex items-center gap-4 rounded-lg border border-surface-200 bg-white p-5 transition-all mb-3 booking-insurance-item"
        :class="{
            'border-primary shadow-sm': selected,
        }"
        @click="$emit('select')"
    >
        <div
            class="flex h-11 w-11 items-center justify-center rounded-lg bg-primary-50 text-primary"
        >
            <i class="pi pi-shield text-xl" />
        </div>
        <div class="flex-1">
            <div class="mb-1 flex items-center gap-2">
                <h3 class="font-semibold text-surface-900">
                    {{ insurance.name }}
                </h3>

                <Tag v-if="insurance.recommended" value="Recommended" severity="success" />
            </div>

            <p class="text-sm text-surface-500">
                {{ insurance.description }}
            </p>
        </div>
        <div class="mr-5 text-right">
            <div class="font-semibold text-surface-900">{{ insurance.price }} € / day</div>
        </div>

        <Checkbox :model-value="selected" binary readonly />
    </div>
</template>
<script setup>
import { Checkbox, Tag } from 'primevue'

defineProps({
    insurance: {
        type: Object,
        required: true,
    },
    selected: Boolean,
    disabled: Boolean,
})

defineEmits(['select'])
</script>
