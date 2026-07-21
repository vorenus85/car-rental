<template>
    <div class="booking-insurance-list">
        <InsuranceItem
            v-for="insurance in insurances"
            :key="insurance.id"
            :insurance="insurance"
            :selected="modelValue === insurance.id"
            @select="handleSelect(insurance.id)"
        />
    </div>
</template>
<script setup>
import InsuranceItem from '@storefront/components/modules/Booking/Insuarance/InsuranceItem.vue'
import { insurances } from '@storefront/data/insurances.js'

defineProps({
    modelValue: {
        type: Number,
        default: null,
    },
})

const emit = defineEmits(['update:modelValue'])

const handleSelect = insuranceId => {
    emit('update:modelValue', insuranceId)
}
</script>
