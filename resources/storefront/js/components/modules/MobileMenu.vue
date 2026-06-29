<template>
    <div
        class="mobile-menu-overlay top-0 right-0 fixed z-50"
        :class="{ active: mobileMenuStore.isOpen }"
        @click="toggle"
    ></div>
    <div
        class="mobile-menu fixed top-0 z-50 flex flex-col px-4"
        :class="{ active: mobileMenuStore.isOpen }"
    >
        <button class="close-mobile-menu self-end flex items-center justify-center cursor-pointer">
            <CloseButton @click="toggleMobileMenu" />
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
        <div class="mobile login-menu text-right">
            <div v-if="authStore?.user?.name" class="layout-topbar-actions flex flex-col gap-3">
                <div>
                    <Button primary @click="toAccount">
                        <i class="pi pi-user"></i>
                        <span>Profile</span>
                    </Button>
                </div>

                <div>
                    <Button class="login-cta" variant="text" @click="toLogout">Logout</Button>
                </div>
            </div>
            <template v-else
                ><Button class="login-cta mr-3" primary @click="toLogin">Login</Button>
            </template>
        </div>
    </div>
</template>
<script setup>
import { useMobileMenuStore } from '@storefront/stores/mobileMenuStore'
import { useHeaderMenu } from '@storefront/composables/useHeaderMenu'
import CloseButton from '@storefront/components/icons/CloseButton.vue'
import { useRedirects } from '@storefront/composables/useRedirects'
import { useAuthStore } from '@storefront/stores/authStore'
import { Button } from 'primevue'

const { headerMenu } = useHeaderMenu()
const mobileMenuStore = useMobileMenuStore()
const { toLogin, toAccount, toLogout } = useRedirects()
const authStore = useAuthStore()

function toggleMobileMenu() {
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
