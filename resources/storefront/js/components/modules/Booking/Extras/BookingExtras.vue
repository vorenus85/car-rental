<template>
    <div class="booking-extras-module">
        <div class="text-lg font-semibold mb-3">Extras</div>

        <ExtrasList v-model:selected-extras="selectedExtras" @select="handleSelection" />
    </div>
</template>
<script setup>
import { onMounted, ref, watch } from 'vue'
import ExtrasList from '@storefront/components/modules/Booking/Extras/ExtrasList.vue'
import { useBookingStore } from '@storefront/stores/bookingStore'

const bookingStore = useBookingStore()
const selectedExtras = ref(bookingStore.extras)

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

watch(
    () => bookingStore.extras,
    newValue => {
        bookingStore.setExtras(newValue)
    },
    { deep: true }
)

onMounted(async () => {
    await bookingStore.setExtras(selectedExtras.value)
})
</script>
