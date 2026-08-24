<template>
    <div class="booking-notes pb-5 mb-5">
        <div class="space-y-4">
            <h2 class="text-lg font-semibold">Notes for booking</h2>
            <label for="notes" class="hidden">Notes for booking</label>
            <Textarea
                id="notes"
                v-model="notes"
                name="notes"
                rows="5"
                style="resize: none"
                placeholder=""
                class="w-full"
            />
        </div>
    </div>
</template>
<script setup>
import { Textarea } from 'primevue'
import { computed } from 'vue'

const props = defineProps({
    modelValue: {
        type: String,
        default: '',
    },
})

const emit = defineEmits(['update:modelValue'])

const notes = computed({
    get: () => props.modelValue,
    set: value => emit('update:modelValue', value),
})
</script>
