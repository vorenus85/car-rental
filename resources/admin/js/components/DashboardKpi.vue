<template>
    <div class="rounded-xl border border-surface-200 bg-white p-5 shadow-sm">
        <div class="flex items-start justify-between">
            <div class="flex items-start justify-between gap-4">
                <div
                    class="flex h-18 w-18 items-center justify-center rounded-lg bg-primary-50 text-primary-500"
                >
                    <i class="pi pi-car" :class="`pi-${icon}`" style="font-size: 1.5rem"></i>
                </div>
                <div>
                    <span class="text-sm font-medium text-surface-500"> {{ title }} </span>

                    <div class="mt-2 flex items-baseline gap-2">
                        <span class="text-3xl font-bold text-surface-900">
                            {{ value }}
                        </span>

                        <span class="text-sm text-surface-500"> {{ unit }} </span>
                    </div>
                </div>
            </div>

            <!-- Icon -->
            <div
                class="flex h-11 w-11 items-center justify-center rounded-lg bg-blue-50 text-primary-500"
                @click="link"
            >
                <i class="pi pi-external-link"></i>
            </div>
        </div>
    </div>
</template>

<script setup>
defineProps({
    value: {
        type: Number,
        default: 0,
    },
    title: {
        type: String,
        default: 'Kpi name',
    },
    unit: {
        type: String,
        default: '',
    },
    icon: {
        type: String,
        default: '',
    },
    link: {
        type: Object,
        default: () => {},
    },
})
</script>
