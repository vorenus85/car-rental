<script setup>
import { ConfirmDialog, Toast } from 'primevue'
</script>

<template>
    <RouterView />
    <div>
        <Toast />
        <ConfirmDialog />
        <slot />
    </div>
</template>
