<template>
    <header class="border-b bg-white header">
        <div class="max-w-8xl mx-auto px-4 py-4 flex">
            <HeaderLogo />
            <HeaderLinks class="mx-auto"></HeaderLinks>
            <Button class="header-cta">Book Now</Button>
        </div>
    </header>
</template>
<script setup>
import HeaderLinks from '@storefront/components/modules/HeaderLinks.vue'
import HeaderLogo from '@storefront/components/modules/HeaderLogo.vue'
import { Button } from 'primevue'
</script>
<style scoped lang="scss">
.header {
    background: var(--header-bg);
}

.header-cta {
    --p-button-primary-background: var(--primary-color);
    --p-button-primary-border-color: var(--primary-color);
    --p-button-primary-hover-color: var(--primary-color);
    --p-button-primary-hover-background: #fff;
    --p-button-primary-hover-border-color: #fff;
}
</style>
