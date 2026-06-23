<template>
    <div class="bg-white rounded-xl border border-slate-200">
        <!-- Tabs Header -->
        <div class="flex border-b border-slate-200">
            <div class="px-6 py-4">
                <Skeleton width="80px" height="20px" />
            </div>

            <div class="px-6 py-4">
                <Skeleton width="100px" height="20px" />
            </div>
        </div>

        <!-- Tab Content -->
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-4">
                <div v-for="i in 10" :key="`left-${i}`" class="flex items-center gap-3">
                    <Skeleton shape="circle" size="18px" />
                    <Skeleton width="180px" height="16px" />
                </div>

                <div v-for="i in 10" :key="`right-${i}`" class="flex items-center gap-3">
                    <Skeleton shape="circle" size="18px" />
                    <Skeleton width="200px" height="16px" />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import Skeleton from 'primevue/skeleton'
</script>
