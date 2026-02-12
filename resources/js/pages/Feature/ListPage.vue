<template>
    <AppLayout>
        <PageTitle title="Features">
            <template #actions>
                <Button icon="pi pi-plus" label="New" primary @click="toCreateFeature" />
            </template>
        </PageTitle>
    </AppLayout>
</template>
<script setup>
import AppLayout from '@/layouts/AppLayout.vue'
import PageTitle from '@/components/PageTitle.vue'
import { Button } from 'primevue'
import { useRedirects } from '@/composables/useRedirects.js'

const { toCreateFeature } = useRedirects()
</script>
