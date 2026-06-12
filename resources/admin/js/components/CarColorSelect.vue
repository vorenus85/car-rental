<script setup>
import { Select } from 'primevue'

const colors = [
    { label: 'White', value: 'white', hex: '#FFFFFF' },
    { label: 'Black', value: 'black', hex: '#000000' },
    { label: 'Silver', value: 'silver', hex: '#C0C0C0' },
    { label: 'Gray', value: 'gray', hex: '#808080' },
    { label: 'Blue', value: 'blue', hex: '#2563EB' },
    { label: 'Red', value: 'red', hex: '#DC2626' },
    { label: 'Green', value: 'green', hex: '#16A34A' },
    { label: 'Yellow', value: 'yellow', hex: '#EAB308' },
    { label: 'Orange', value: 'orange', hex: '#F97316' },
    { label: 'Brown', value: 'brown', hex: '#92400E' },
]
</script>

<template>
    <Select
        name="color"
        :options="colors"
        option-label="label"
        option-value="value"
        placeholder="Select color"
        class="w-full"
    >
        <template #option="{ option }">
            <div class="flex items-center gap-3">
                <span
                    class="w-4 h-4 rounded-full border border-gray-300"
                    :style="{ backgroundColor: option.hex }"
                />
                <span>{{ option.label }}</span>
            </div>
        </template>

        <template #value="{ value }">
            <div v-if="value" class="flex items-center gap-3">
                <span
                    class="w-4 h-4 rounded-full border border-gray-300"
                    :style="{
                        backgroundColor: colors.find(c => c.value === value)?.hex,
                    }"
                />
                <span>
                    {{ colors.find(c => c.value === value)?.label }}
                </span>
            </div>

            <span v-else> Select color </span>
        </template>
    </Select>
</template>
