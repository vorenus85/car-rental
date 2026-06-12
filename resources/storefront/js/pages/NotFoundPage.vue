<template>
    <PublicLayout>
        <div
            class="min-h-[500px] xl:min-h-[700px] lg:min-h-[600px] flex items-center justify-center"
        >
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
                        <Button label="Back to homepage" severity="secondary" @click="toHome">
                            <template #icon>
                                <UiIcon icon="arrow-left" />
                            </template>
                        </Button>
                    </div>
                </template>
            </Card>
        </div>
    </PublicLayout>
</template>
<script setup>
import PublicLayout from '@storefront/layouts/PublicLayout.vue'
import UiIcon from '@storefront/components/PiIcon.vue'
import { Button, Card } from 'primevue'
import { useRedirects } from '@storefront/composables/useRedirects'

const { toHome } = useRedirects()
</script>
