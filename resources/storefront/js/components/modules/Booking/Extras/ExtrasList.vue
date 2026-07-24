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
import { useExtra } from '@storefront/composables/useExtra'
import { onMounted, ref } from 'vue'

const extras = ref([])
const { getExtras } = useExtra()

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

onMounted(async () => {
    extras.value = await getExtras()
})
</script>
