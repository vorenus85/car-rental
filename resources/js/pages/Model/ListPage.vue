<template>
    <AppLayout>
        <PageTitle title="Models">
            <template #actions>
                <Button icon="pi pi-plus" label="New" primary @click="toCreateModel" />
            </template>
        </PageTitle>
    </AppLayout>
</template>
<script setup>
import AppLayout from '@/layouts/AppLayout.vue'
import PageTitle from '@/components/PageTitle.vue'
import { Button } from 'primevue'
import { useRedirects } from '@/composables/useRedirects.js'

const { toCreateModel } = useRedirects()
</script>
