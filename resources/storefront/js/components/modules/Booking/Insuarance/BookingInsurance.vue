<template>
    <div class="booking-insurance-module">
        <div class="text-lg font-semibold mb-3">Insurance Options</div>
        <InsuaranceList v-model="selectedInsurance" />
    </div>
</template>
<script setup>
import InsuaranceList from '@storefront/components/modules/Booking/Insuarance/InsuaranceList.vue'
import { ref } from 'vue'

const selectedInsurance = ref(2)
</script>
