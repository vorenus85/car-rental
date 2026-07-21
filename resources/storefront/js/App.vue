<template>
    <RouterView />
    <div>
        <Toast />
        <ConfirmDialog />
        <slot />
    </div>
    <MobileMenu />
</template>
<script setup>
import { ConfirmDialog, Toast } from 'primevue'
import MobileMenu from '@storefront/components/modules/MobileMenu.vue'
</script>
