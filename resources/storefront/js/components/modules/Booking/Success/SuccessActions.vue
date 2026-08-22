<template>
    <Button
        label="Download Confirmation"
        icon="pi pi-download"
        outlined
        :disabled="!downloadUrl"
        @click="downloadConfirmation"
    />

    <Button label="View My Bookings" icon="pi pi-list" @click="toProfileBookings" />

    <Button label="Back to Home" icon="pi pi-home" severity="secondary" text @click="toHome" />
</template>
<script setup>
import { Button } from 'primevue'
import { useRedirects } from '@storefront/composables/useRedirects'

const props = defineProps({
    downloadUrl: {
        type: String,
        default: '',
    },
})

const { toHome, toProfileBookings } = useRedirects()

const downloadConfirmation = () => {
    if (!props.downloadUrl) {
        return
    }

    window.location.assign(props.downloadUrl)
}
</script>
