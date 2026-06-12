<template>
    <header class="border-b bg-white header">
        <div class="max-w-8xl mx-auto px-4 py-4 flex items-center">
            <HeaderLogo />
            <HeaderLinks class="mx-auto items-center"></HeaderLinks>
            <Button class="header-cta ml-auto lg:ml-0">Book Now</Button>
            <div class="flex lg:hidden ml-5 p-0">
                <Button
                    class="btn-mobile-menu"
                    severity="secondary"
                    aria-label="Mobile menu"
                    @click="toggle"
                >
                    <HamburgerMenu class="cursor-pointer" />
                </Button>
            </div>
        </div>
    </header>
</template>
<script setup>
import HeaderLinks from '@storefront/components/modules/HeaderLinks.vue'
import HeaderLogo from '@storefront/components/modules/HeaderLogo.vue'
import { Button } from 'primevue'
import { useMobileMenuStore } from '@storefront/stores/useMobileMenuStore'
import HamburgerMenu from '@storefront/components/icons/HamburgerMenu.vue'

const mobileMenuStore = useMobileMenuStore()

function toggle() {
    mobileMenuStore.toggleMenu()
}
</script>
<style scoped lang="scss">
.header {
    background: var(--header-bg);
}

.btn-mobile-menu {
    padding: 0;
}

.header-cta {
    --p-button-primary-background: var(--primary-color);
    --p-button-primary-border-color: var(--primary-color);
    --p-button-primary-color: var(--secondary-color);

    --p-button-primary-hover-color: var(--primary-color);
    --p-button-primary-hover-background: #fff;
    --p-button-primary-hover-border-color: #fff;

    --p-button-primary-active-color: #fff;
    --p-button-primary-active-background: var(--primary-active-color);
    --p-button-primary-active-border-color: var(--primary-active-color);
}
</style>
