<template>
    <Card class="overflow-hidden">
        <template #header>
            <div class="p-4">
                <Skeleton width="100%" height="14rem" />
            </div>
        </template>

        <template #content>
            <div>
                <!-- Title -->
                <Skeleton width="70%" height="1.5rem" class="mb-3" />

                <!-- Tags -->
                <div class="flex gap-2 mb-4">
                    <Skeleton width="4rem" height="2rem" />
                    <Skeleton width="5rem" height="2rem" />
                </div>

                <!-- Specs -->
                <div class="grid grid-cols-2 gap-4 mb-5">
                    <div v-for="i in 4" :key="i" class="flex items-center gap-2">
                        <Skeleton shape="circle" size="1.25rem" />
                        <Skeleton width="5rem" height="1rem" />
                    </div>
                </div>

                <Divider />

                <!-- Footer -->
                <div class="flex items-center justify-between mt-4">
                    <div>
                        <Skeleton width="5rem" height="2rem" class="mb-1" />
                        <Skeleton width="3rem" height="1rem" />
                    </div>

                    <Skeleton width="8rem" height="2.5rem" />
                </div>
            </div>
        </template>
    </Card>
</template>
<script setup>
import Card from 'primevue/card'
import Skeleton from 'primevue/skeleton'
import Divider from 'primevue/divider'
</script>
