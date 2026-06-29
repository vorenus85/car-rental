<template>
    <header class="border-b bg-white header">
        <div class="max-w-8xl mx-auto px-4 py-4 flex items-center">
            <HeaderLogo />
            <HeaderLinks class="mx-auto items-center"></HeaderLinks>
            <div class="login-module hidden lg:flex">
                <div v-if="authStore?.user?.name" class="layout-topbar-actions">
                    <Button
                        outlined
                        class="layout-topbar-action flex items-start gap-1 mr-3"
                        aria-haspopup="true"
                        aria-controls="profile_menu"
                        @click="toggleProfileMenu"
                    >
                        <i class="pi pi-user"></i>
                        <span>{{ authStore?.user?.name }}</span>
                    </Button>
                    <Menu id="profile_menu" ref="menu" :model="topbarMenuItems" :popup="true" />
                </div>
                <Button v-else class="login-cta mr-3" outlined @click="toLogin">Login</Button>
            </div>

            <Button class="header-cta ml-auto lg:ml-0">Book Now</Button>
            <div class="flex lg:hidden ml-5 p-0">
                <Button
                    class="btn-mobile-menu"
                    severity="secondary"
                    aria-label="Mobile menu"
                    @click="toggleMobileMenu"
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
import { Button, Menu } from 'primevue'
import { useMobileMenuStore } from '@storefront/stores/mobileMenuStore'
import HamburgerMenu from '@storefront/components/icons/HamburgerMenu.vue'
import { useRedirects } from '@storefront/composables/useRedirects'
import { useAuthStore } from '@storefront/stores/authStore'
import { useRouter } from 'vue-router'
import { ref } from 'vue'

const mobileMenuStore = useMobileMenuStore()
const router = useRouter()
const authStore = useAuthStore()

function toggleMobileMenu() {
    mobileMenuStore.toggleMenu()
}

const topbarMenuItems = ref([
    {
        items: [
            {
                label: 'Profile',
                command: () => {
                    router.push('/account/profile')
                },
            },
            {
                label: 'Logout',
                command: () => {
                    router.push('/logout')
                },
            },
        ],
    },
])
const menu = ref()
const toggleProfileMenu = event => {
    menu.value.toggle(event)
}

const { toLogin } = useRedirects()
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
