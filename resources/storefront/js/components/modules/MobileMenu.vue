<template>
    <div
        class="mobile-menu-overlay top-0 right-0 fixed z-50"
        :class="{ active: mobileMenuStore.isOpen }"
        @click="toggle"
    ></div>
    <div
        class="mobile-menu fixed top-0 z-50 flex flex-col"
        :class="{ active: mobileMenuStore.isOpen }"
    >
        <button class="close-mobile-menu self-end flex items-center justify-center cursor-pointer">
            <CloseButton @click="toggle" />
        </button>
        <div class="mobile-menu-common flex flex-col">
            <RouterLink
                v-for="menu in headerMenu"
                :key="menu.id"
                :to="{ name: menu.name }"
                class="mobile-menu-item mb-1"
                >{{ menu.title }}</RouterLink
            >
        </div>
        <div class="mobile login-menu"></div>
    </div>
</template>
<script setup>
import { useMobileMenuStore } from '@storefront/stores/useMobileMenuStore'
import { useHeaderMenu } from '@storefront/composables/useHeaderMenu'
import CloseButton from '@storefront/components/icons/CloseButton.vue'

const { headerMenu } = useHeaderMenu()
const mobileMenuStore = useMobileMenuStore()

function toggle() {
    mobileMenuStore.toggleMenu()
}
</script>
<style lang="scss">
.mobile-menu-overlay {
    width: 100%;
    height: 100%;
    left: 0;
    top: 0;
    opacity: 0;
    visibility: hidden;
    transition: var(--transition-all);
    background: rgba(0, 0, 0, 0.7);
    &.active {
        opacity: 1;
        visibility: visible;
    }
}

.mobile-menu {
    background: #fff;
    width: 70vw;
    right: -70vw;
    transition: var(--transition-all);
    top: 0;
    min-height: 100vh;
    padding-top: 1rem;
    &.active {
        right: 0;
    }
}

.close-mobile-menu {
    width: 40px;
    height: 40px;

    svg {
        border-radius: 100%;
        border: 1px solid;
    }
}

.mobile-menu-item {
    padding: 0.25rem 0.5rem;
    text-align: right;
    font-size: 1.25rem;
}
</style>
