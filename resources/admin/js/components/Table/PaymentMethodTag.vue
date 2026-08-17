<template>
    <span class="payment-method-tag font-medium no-wrap" :class="`type-${status}`">
        {{ statusLabel }}
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

const typeLabels = {
    stripe: 'Stripe',
    paypal: 'PayPal',
    cash: 'Cash',
}

const statusLabel = computed(() => {
    return typeLabels[props.status] ?? props.status
})
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

.payment-method-tag::before {
    content: '';
    display: inline-block;
    width: 8px;
    height: 8px;
    border-radius: 50%;
}

/* Stripe */
.type-stripe {
    background: #e0e7ff;
}

.type-stripe::before {
    background: #4f46e5;
}

/* PayPal */
.type-paypal {
    background: #dbeafe;
}

.type-paypal::before {
    background: #2563eb;
}

/* Cash */
.type-cash {
    background: #dcfce7;
}

.type-cash::before {
    background: #15803d;
}
</style>
