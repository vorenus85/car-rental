<template>
    <main>
        <div class="h-screen flex items-center justify-center">
            <Card class="p-4 py-6 sm:p-12">
                <template #content>
                    <div
                        class="flex flex-col gap-6 md:gap-8 items-center justify-center text-center"
                    >
                        <h1 class="font-extrabold text-2xl md:text-4xl text-primary">404</h1>
                        <h2 class="font-extrabold text-4xl md:text-6xl">Not Found</h2>
                        <p class="text-xl font-semibold text-muted-color">
                            Sorry, the resource you are looking for could not be found.
                        </p>
                        <Button label="Back to homepage" severity="secondary" @click="toDashboard">
                            <template #icon>
                                <UiIcon icon="arrow-left" />
                            </template>
                        </Button>
                    </div>
                </template>
            </Card>
        </div>
    </main>
</template>
<script setup>
import { Button, Card } from 'primevue'
import UiIcon from '@/components/UiIcon.vue'
import { useRedirects } from '@/composables/useRedirects'

const { toDashboard } = useRedirects()
</script>
