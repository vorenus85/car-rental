<template>
    <div class="booking-extras-list">
        <ExtraItem
            v-for="extra in extras"
            :key="extra.id"
            :extra="extra"
            :selected-extra="selectedExtras.find(item => item.id === extra.id)"
            @select="handleSelect"
        />
    </div>
</template>
<script setup>
import ExtraItem from '@storefront/components/modules/Booking/Extras/ExtraItem.vue'
import { extras } from '@storefront/data/extras.js'

defineProps({
    selectedExtras: {
        type: Array,
        default: () => [],
    },
    modelValue: {
        type: Number,
        default: null,
    },
})

const emit = defineEmits(['select'])

const handleSelect = ({ id, quantity }) => {
    emit('select', { id, quantity })
}
</script>
