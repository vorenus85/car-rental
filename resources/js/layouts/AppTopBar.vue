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
                    <div class="flex gap-3"><LogoIcon></LogoIcon> Wheelzie</div>
                </router-link>
            </div>
        </div>
        <div class="layout-topbar-actions"></div>
    </header>
</template>
<script setup>
import UiIcon from '@/components/UiIcon.vue'
import LogoIcon from '@/components/LogoIcon.vue'
import { useLayoutStore } from '@/stores/layout'

const layoutStore = useLayoutStore()
</script>
