<script setup>
import { ConfirmDialog, Toast } from 'primevue'
import MobileMenu from '@storefront/components/modules/MobileMenu.vue'
</script>

<template>
    <RouterView />
    <div>
        <Toast />
        <ConfirmDialog />
        <slot />
    </div>
    <MobileMenu />
</template>
