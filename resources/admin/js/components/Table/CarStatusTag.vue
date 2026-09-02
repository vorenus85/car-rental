<template>
    <span class="car-status-tag font-medium no-wrap" :class="`status-${normalizedStatus}`">
        {{ status }}
    </span>
</template>
<script setup>
import { computed } from 'vue'

const props = defineProps({
    status: {
        type: String,
        default: 'available',
    },
})

const normalizedStatus = computed(() => props.status.toLowerCase().replace(/\s+/g, '-'))
</script>
<style scoped>
.car-status-tag {
    display: inline-flex;
    gap: 5px;
    padding: 5px 10px;
    border-radius: 25px;
    justify-content: center;
    align-items: center;
    font-size: 0.75rem;
}

.car-status-tag:before {
    content: '';
    display: inline-block;
    width: 8px;
    height: 8px;
    border-radius: 100%;
}

.status-available {
    background: #dcfce7;
}

.status-available:before {
    background: #15803d;
}

.status-maintenance {
    background: #fee2e2;
}

.status-maintenance:before {
    background: #b91c1c;
}

.status-inactive {
    background: #f1f5f9;
}

.status-inactive:before {
    background: #475569;
}
</style>
