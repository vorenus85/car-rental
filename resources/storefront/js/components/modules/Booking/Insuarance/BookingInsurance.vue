<template>
    <div class="booking-insurance-module">
        <div class="text-lg font-semibold mb-3">Insurance</div>
        <InsuaranceList v-model="selectedInsurance" />
    </div>
</template>
<script setup>
import InsuaranceList from '@storefront/components/modules/Booking/Insuarance/InsuaranceList.vue'
import { onMounted, ref, watch } from 'vue'
import { useBookingStore } from '@storefront/stores/bookingStore'

const bookingStore = useBookingStore()
const selectedInsurance = ref(bookingStore.insuranceId)

watch(selectedInsurance, newValue => {
    bookingStore.setInsurance(newValue)
})

onMounted(() => {
    bookingStore.setInsurance(selectedInsurance.value)
})
</script>
