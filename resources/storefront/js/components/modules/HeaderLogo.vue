<template>
    <div class="header-logo">
        <RouterLink :to="{ name: 'home' }" class="header-logo-link flex align-center gap-2">
            <LogoIcon :size="40"></LogoIcon>
            <div class="header-logo-text">
                <div class="brand-name text-white text-bold">
                    Driven<span class="color-primary">GO</span>
                </div>
                <small class="text-white">Car Rental</small>
            </div>
        </RouterLink>
    </div>
</template>

<script setup>
import LogoIcon from '@storefront/components/modules/LogoIcon.vue'
</script>
<style scoped lang="scss">
.brand-name {
    font-weight: 600;
    font-size: 1.5rem;
}

.header-logo-text {
    line-height: 1;
    display: flex;
    gap: 0.25rem;
    flex-direction: column;

    small {
        opacity: 0.5;
        transition: opacity 0.2s;
    }

    &:hover small {
        opacity: 1;
    }
}
</style>
