<template>
    <Button label="Download Confirmation" icon="pi pi-download" outlined />

    <Button label="View My Bookings" icon="pi pi-list" />

    <Button label="Back to Home" icon="pi pi-home" severity="secondary" text @click="toHome" />
</template>
<script setup>
import { Button } from 'primevue'
import { useRedirects } from '@storefront/composables/useRedirects'

const { toHome } = useRedirects()
</script>
