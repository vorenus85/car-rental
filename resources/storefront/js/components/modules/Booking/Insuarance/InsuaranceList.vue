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

const insurances = [
    {
        id: 1,
        name: 'Full Coverage',
        description: 'Excess reduction to 0 €. Covers theft and accidental damage.',
        price: 10,
        recommended: true,
    },
    {
        id: 2,
        name: 'Basic Coverage',
        description: 'Included in your booking.',
        price: 0,
        recommended: false,
    },
]

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
