<template>
    <span class="status-tag font-medium" :class="`status-${status}`">
        {{ status }}
    </span>
</template>
<script setup>
defineProps({
    status: {
        type: String,
        default: 'available',
    },
})
</script>
<style scoped>
.status-tag {
    display: inline-flex;
    gap: 5px;
    padding: 5px 10px;
    border-radius: 25px;
    justify-content: center;
    align-items: center;
    font-size: 0.75rem;
}

.status-tag:before {
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

.status-reserved {
    background: #e0f2fe;
}

.status-reserved:before {
    background: #0369a1;
}

.status-rented {
    background: #ffedd5;
}

.status-rented:before {
    background: #c2410c;
}

.status-maintenance {
    background: #fee2e2;
}

.status-maintenance:before {
    background: #b91c1c;
}

.status-retired {
    background: #f1f5f9;
}

.status-retired:before {
    background: #475569;
}
</style>
