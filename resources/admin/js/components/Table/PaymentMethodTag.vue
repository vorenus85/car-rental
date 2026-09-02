<template>
    <span class="payment-method-tag font-medium no-wrap" :class="`type-${normalizedStatus}`">
        {{ status }}
    </span>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
    status: {
        type: String,
        default: 'stripe',
    },
})

const normalizedStatus = computed(() => props.status.toLowerCase().replace(/\s+/g, '-'))
</script>

<style scoped>
.payment-method-tag {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
    padding: 5px 10px;
    border-radius: 25px;
    font-size: 0.75rem;
}

/* Stripe */
.type-stripe {
    background: #e0e7ff;
}

/* PayPal */
.type-paypal {
    background: #dbeafe;
}

/* Cash */
.type-cash {
    background: #dcfce7;
}
</style>
