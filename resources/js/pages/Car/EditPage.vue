<template>
    <AppLayout>
        <PageTitle title="Edit Car">
            <template #actions>
                <Button icon="pi pi-angle-left" label="Back to list" primary @click="toCarsList" />
            </template>
        </PageTitle>
    </AppLayout>
</template>
<script setup>
import AppLayout from '@/layouts/AppLayout.vue'
import PageTitle from '@/components/PageTitle.vue'
import { Button } from 'primevue'
import { useRedirects } from '@/composables/useRedirects.js'

const { toCarsList } = useRedirects()
</script>
