<template>
    <div
        class="flex items-center justify-between rounded-xl border border-surface-200 bg-white p-4 booking-extra-item mb-3"
        :class="{
            'border-primary shadow-sm': selected,
        }"
    >
        <div class="flex items-start gap-3">
            <i class="pi pi-user text-primary mt-1 text-lg" />

            <div>
                <h4 class="font-semibold text-surface-900">
                    {{ extra.name }}
                </h4>

                <p class="mt-1 text-sm text-surface-500">
                    {{ extra.description }}
                </p>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <span class="font-semibold whitespace-nowrap"> €{{ extra.price }} / day </span>

            <div class="flex items-center overflow-hidden rounded-lg border border-surface-300">
                <Button icon="pi pi-minus" severity="secondary" text @click="decrease" />

                <span class="flex w-10 justify-center font-medium">
                    {{ quantity }}
                </span>

                <Button severity="secondary" icon="pi pi-plus" text @click="increase" />
            </div>
        </div>
    </div>
</template>
<script setup>
import { Button } from 'primevue'
import { computed, ref, watch } from 'vue'

const props = defineProps({
    extra: {
        type: Object,
        required: true,
    },
})

const emit = defineEmits(['select'])

const quantity = ref(0)

const selected = computed(() => quantity.value > 0)

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
