<template>
    <span class="payment-status-tag font-medium no-wrap" :class="`status-${normalizedStatus}`">
        {{ status }}
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

const normalizedStatus = computed(() => props.status.toLowerCase().replace(/\s+/g, '-'))
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

/* Pending */
.status-pending {
    background: #fef3c7;
}
/* Paid */
.status-paid {
    background: #dcfce7;
}

/* Failed */
.status-failed {
    background: #fee2e2;
}

/* Refunded */
.status-refunded {
    background: #f1f5f9;
}

/* Partially Refunded */
.status-partially-refunded {
    background: #ffedd5;
}

/* Cancelled */
.status-cancelled {
    background: #f3f4f6;
}
</style>
