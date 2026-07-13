<template>
    <div
        class="flex flex-col sm:flex-row items-center justify-between rounded-xl border border-surface-200 bg-white p-4 booking-extra-item mb-3 gap-2"
        :class="{
            'border-primary shadow-sm': selected,
        }"
    >
        <div class="flex items-center gap-3 flex-col sm:flex-row">
            <div
                class="flex h-11 w-11 items-center justify-center rounded-lg bg-primary-50 text-primary"
            >
                <PiIcon :icon="extra.icon" class="text-primary mt-1 text-lg" />
            </div>

            <div class="flex flex-1 items-start flex-col gap-1">
                <h4 class="font-semibold text-surface-900">
                    {{ extra.name }}
                </h4>

                <p class="mt-1 text-sm text-surface-500">
                    {{ extra.description }}
                </p>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row items-center gap-2">
            <span class="font-semibold whitespace-nowrap"> €{{ extra.price }} / day </span>

            <div class="flex items-center overflow-hidden rounded-lg border border-surface-300">
                <Button icon="pi pi-minus" severity="secondary" text @click="decrease" />

                <span class="flex w-10 justify-center font-medium">
                    {{ quantity }}
                </span>

                <Button
                    severity="secondary"
                    icon="pi pi-plus"
                    text
                    @click="increase"
                    :disabled="extra?.maxQuantity === 1 && quantity === 1"
                />
            </div>
        </div>
    </div>
</template>
<script setup>
import { Button } from 'primevue'
import { computed, ref, watch } from 'vue'
import PiIcon from '@storefront/components/PiIcon.vue'

const props = defineProps({
    extra: {
        type: Object,
        required: true,
    },
    selectedExtra: {
        type: Object,
        default: null,
    },
})

const emit = defineEmits(['select'])

const quantity = ref(0)

watch(
    () => props.selectedExtra,
    value => {
        quantity.value = value?.quantity ?? 0
    },
    { immediate: true }
)

const selected = computed(() => props.selectedExtra !== null)

watch(quantity, newValue => {
    emit('select', { id: props.extra.id, quantity: newValue })
})

const decrease = () => {
    if (quantity.value > 0) {
        quantity.value--
    }
}

const increase = () => {
    quantity.value++
}
</script>
