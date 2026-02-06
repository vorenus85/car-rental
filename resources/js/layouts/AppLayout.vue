<template>
    <div
        class="min-h-screen layout-wrapper"
        :class="{ 'sidebar-is-toggled': layoutStore.isDrawerOpen }"
    >
        <AppTopBar />
        <AppSideBar />

        <div class="layout-main-container">
            <main class="layout-main"><slot /></main>
        </div>
        <div class="layout-mask animate-fadein" @click="layoutStore.toggleDrawer"></div>
    </div>
</template>

<script setup>
import AppTopBar from '@/layouts/AppTopBar.vue'
import AppSideBar from '@/layouts/AppSideBar.vue'
import { useLayoutStore } from '@/stores/layout'
import { useLayout } from '@/composables/useLayout'
import { onBeforeRouteLeave } from 'vue-router'

const { isMobile } = useLayout()
const layoutStore = useLayoutStore()

onBeforeRouteLeave((to, from, next) => {
    if (!isMobile.value) {
        next()
        return
    }

    layoutStore.closeDrawer()

    setTimeout(() => {
        next()
    }, 250)
})
</script>
