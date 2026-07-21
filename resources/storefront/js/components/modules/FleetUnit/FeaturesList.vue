<template>
    <div class="grid grid-cols-2 gap-y-4">
        <template v-for="feature in features" :key="feature">
            <div class="flex items-center gap-2">
                <i class="pi pi-check-circle text-green-500" />
                <span>{{ feature.name }}</span>
            </div>
        </template>
    </div>
</template>
<script setup>
defineProps({ features: { type: Array, default: () => [] } })
</script>
