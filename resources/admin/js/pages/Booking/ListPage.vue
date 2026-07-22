<template>
    <AppLayout>
        <PageTitle title="Bookings">
            <template #actions>
                <Button icon="pi pi-plus" label="New" primary @click="toCreateBooking" />
            </template>
        </PageTitle>
        <div class="card shadow list-page">Booking list page</div>
    </AppLayout>
</template>
<script setup>
import AppLayout from '@admin/layouts/AppLayout.vue'
import PageTitle from '@admin/components/PageTitle.vue'
import { useRedirects } from '@admin/composables/useRedirects.js'
import { Button } from 'primevue'

const { toCreateBooking } = useRedirects()
</script>
