<template>
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Image -->
        <div class="lg:col-span-5">
            <Skeleton width="100%" height="420px" border-radius="12px" />
        </div>

        <!-- Car details -->
        <div class="lg:col-span-4 space-y-6">
            <div class="space-y-3">
                <Skeleton width="80px" height="18px" />
                <Skeleton width="280px" height="42px" />
                <Skeleton width="70px" height="20px" />
            </div>

            <div class="space-y-2">
                <Skeleton width="100%" height="18px" />
                <Skeleton width="90%" height="18px" />
                <Skeleton width="70%" height="18px" />
            </div>

            <!-- Features -->
            <div class="grid grid-cols-4 gap-6 pt-4">
                <div v-for="i in 8" :key="i" class="flex flex-col items-center gap-2">
                    <Skeleton shape="circle" size="28px" />
                    <Skeleton width="60px" height="12px" />
                </div>
            </div>
        </div>

        <!-- Booking card -->
        <div class="lg:col-span-3">
            <div class="background-white rounded-xl p-6 space-y-5 border border-slate-200">
                <Skeleton width="120px" height="42px" />

                <Skeleton width="100%" height="52px" />

                <div class="grid grid-cols-2 gap-3">
                    <Skeleton width="100%" height="52px" />
                    <Skeleton width="100%" height="52px" />
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <Skeleton width="100%" height="52px" />
                    <Skeleton width="100%" height="52px" />
                </div>

                <Skeleton width="100%" height="52px" />

                <Skeleton width="100%" height="56px" />
            </div>
        </div>
    </div>
</template>

<script setup>
import Skeleton from 'primevue/skeleton'
</script>
