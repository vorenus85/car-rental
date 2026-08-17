<template>
    <span class="booking-status-tag font-medium no-wrap" :class="`status-${normalizedStatus}`">
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
.booking-status-tag {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
    padding: 5px 10px;
    border-radius: 25px;
    font-size: 0.75rem;
}

.booking-status-tag::before {
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

/* Confirmed */
.status-confirmed {
    background: #dcfce7;
}

.status-confirmed::before {
    background: #15803d;
}

/* Picked Up */
.status-picked-up {
    background: #dbeafe;
}

.status-picked-up::before {
    background: #2563eb;
}

/* Returned */
.status-returned {
    background: #f1f5f9;
}

.status-returned::before {
    background: #475569;
}

/* Cancelled */
.status-cancelled {
    background: #fee2e2;
}

.status-cancelled::before {
    background: #b91c1c;
}
</style>
