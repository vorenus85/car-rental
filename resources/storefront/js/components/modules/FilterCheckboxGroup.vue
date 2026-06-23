<template>
    <AccordionPanel :value="panelValue">
        <AccordionHeader> {{ title }} </AccordionHeader>
        <AccordionContent
            ><div class="space-y-3">
                <div v-for="item in items" :key="item" class="flex items-center gap-3">
                    <Checkbox
                        :value="item.value"
                        :input-id="`${idPrefix}-${item.value}`"
                        :model-value="modelValue"
                        @update:model-value="emit('update:modelValue', $event)"
                    />
                    <label :for="`${idPrefix}-${item.value}`">
                        {{ item.label }} {{ suffix }}
                    </label>
                </div>
            </div></AccordionContent
        >
    </AccordionPanel>
</template>
<script setup>
import { AccordionContent, AccordionHeader, AccordionPanel, Checkbox } from 'primevue'

const emit = defineEmits(['update:modelValue'])

defineProps({
    title: { type: String, default: null },
    panelValue: { type: String, default: null },
    items: { type: Array, default: () => {} },
    modelValue: { type: Array, default: () => {} },
    idPrefix: { type: String, default: null },
    suffix: { type: String, default: null },
})
</script>
