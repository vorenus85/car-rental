<template>
    <header class="bg-white shadow layout-topbar">
        <div class="layout-topbar-logo-container flex">
            <button
                type="button"
                class="layout-menu-button layout-topbar-action"
                @click="layoutStore.toggleDrawer"
            >
                <UiIcon icon="bars"></UiIcon>
            </button>
            <div class="app-name">
                <router-link to="/">
                    <div class="flex gap-3"><LogoIcon></LogoIcon> DrivenGo</div>
                </router-link>
            </div>
        </div>
        <div class="layout-topbar-actions">
            <button
                type="button"
                class="layout-topbar-action flex items-start gap-1"
                aria-haspopup="true"
                aria-controls="profile_menu"
                @click="toggle"
            >
                <i class="pi pi-user"></i>
                <div class="hidden md:flex flex-col items-start leading-tight">
                    <div>{{ authStore.user.name }}</div>
                    <span class="text-muted-color text-sm">Admin</span>
                </div>
            </button>
            <Menu id="profile_menu" ref="menu" :model="topbarMenuItems" :popup="true" />
        </div>
    </header>
</template>
<script setup>
import UiIcon from '@admin/components/UiIcon.vue'
import LogoIcon from '@admin/components/LogoIcon.vue'
import { useLayoutStore } from '@admin/stores/layout'
import { useAuthStore } from '@admin/stores/auth'
import { Menu } from 'primevue'
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const layoutStore = useLayoutStore()
const authStore = useAuthStore()
const topbarMenuItems = ref([
    {
        items: [
            {
                label: 'Profile',
                command: () => {
                    router.push('/account/profile')
                },
                icon: 'pi pi-user',
            },
            {
                label: 'Change Password',
                command: () => {
                    router.push('/account/password')
                },
                icon: 'pi pi-lock',
            },
            {
                label: 'Logout',
                command: () => {
                    router.push('/logout')
                },
                icon: 'pi pi-sign-out',
            },
        ],
    },
])
const menu = ref()
const toggle = event => {
    menu.value.toggle(event)
}
</script>
