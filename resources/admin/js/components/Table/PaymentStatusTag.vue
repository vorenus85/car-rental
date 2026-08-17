<template>
    <span class="payment-status-tag font-medium no-wrap" :class="`status-${status}`">
        {{ statusLabel }}
    </span>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
    status: {
        type: String,
        default: 'pending',
    },
})

const statusLabels = {
    pending: 'Pending',
    paid: 'Paid',
    failed: 'Failed',
    refunded: 'Refunded',
    partially_refunded: 'Partially Refunded',
    cancelled: 'Cancelled',
}

const statusLabel = computed(() => {
    return statusLabels[props.status] ?? props.status
})
</script>

<style scoped>
.payment-status-tag {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
    padding: 5px 10px;
    border-radius: 25px;
    font-size: 0.75rem;
}

.payment-status-tag::before {
    content: '';
    display: inline-block;
    width: 8px;
    height: 8px;
    border-radius: 50%;
}

/* Pending */
.status-pending {
    background: #fef3c7;
}

.status-pending::before {
    background: #d97706;
}

/* Paid */
.status-paid {
    background: #dcfce7;
}

.status-paid::before {
    background: #15803d;
}

/* Failed */
.status-failed {
    background: #fee2e2;
}

.status-failed::before {
    background: #b91c1c;
}

/* Refunded */
.status-refunded {
    background: #f1f5f9;
}

.status-refunded::before {
    background: #475569;
}

/* Partially Refunded */
.status-partially_refunded {
    background: #ffedd5;
}

.status-partially_refunded::before {
    background: #c2410c;
}

/* Cancelled */
.status-cancelled {
    background: #f3f4f6;
}

.status-cancelled::before {
    background: #6b7280;
}
</style>
