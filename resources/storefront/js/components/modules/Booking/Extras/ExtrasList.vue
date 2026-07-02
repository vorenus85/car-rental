<template>
    <div class="booking-extras-list">
        <ExtraItem v-for="extra in extras" :key="extra.id" :extra="extra" @select="handleSelect" />
    </div>
</template>
<script setup>
import ExtraItem from '@storefront/components/modules/Booking/Extras/ExtraItem.vue'

const extras = [
    {
        id: 1,
        name: 'Professional Chauffeur',
        description:
            'Travel comfortably with a professional chauffeur available throughout your rental period.',
        price: 180,
        icon: 'user',
    },
    {
        id: 2,
        name: 'Child Seat',
        description: 'Safety seat for children under 12 years old.',
        price: 10,
        icon: 'heart',
    },
    {
        id: 3,
        name: 'Wi-Fi Hotspot',
        description:
            'Stay connected on the road with unlimited high-speed mobile internet for all your devices.',
        price: 7,
        icon: 'wifi',
    },
    {
        id: 4,
        name: 'GPS Navigation',
        description: 'Dedicated GPS navigation system with up-to-date maps.',
        price: 8,
        icon: 'map',
    },
    {
        id: 5,
        name: 'Pet Travel Kit',
        description: 'Includes a protective seat cover and safety harness for your pet.',
        price: 9,
        icon: 'star',
    },
]

defineProps({
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
