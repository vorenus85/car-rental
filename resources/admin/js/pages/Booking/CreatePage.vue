<template>
    <AppLayout>
        <PageTitle title="Add new Booking">
            <template #actions>
                <Button
                    icon="pi pi-angle-left"
                    label="Back to list"
                    severity="secondary"
                    outlined
                    link
                    size="small"
                    @click="toBookingsList"
                />
            </template>
        </PageTitle>
        <div class="card shadow list-page">Booking create page</div>
    </AppLayout>
</template>
<script setup>
import AppLayout from '@admin/layouts/AppLayout.vue'
import PageTitle from '@admin/components/PageTitle.vue'
import { useRedirects } from '@admin/composables/useRedirects.js'
import { Button } from 'primevue'

const { toBookingsList } = useRedirects()
</script>
