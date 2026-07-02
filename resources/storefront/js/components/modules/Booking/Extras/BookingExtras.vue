<template>
    <div class="booking-extras-module">
        <div class="text-lg font-semibold mb-3">Extras</div>

        <ExtrasList @select="handleSelection" />
    </div>
</template>
<script setup>
import ExtrasList from '@storefront/components/modules/Booking/Extras/ExtrasList.vue'
import { ref } from 'vue'

const selectedExtras = ref([])

const handleSelection = ({ id, quantity }) => {
    const index = selectedExtras.value.findIndex(extra => extra.id === id)

    if (quantity === 0) {
        if (index !== -1) {
            selectedExtras.value.splice(index, 1)
        }
        return
    }

    if (index !== -1) {
        selectedExtras.value[index].quantity = quantity
        return
    }

    selectedExtras.value.push({ id, quantity })
}
</script>
