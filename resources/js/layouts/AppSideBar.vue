<template>
    <div class="layout-sidebar shadow">
        <ul class="sidebar-menu">
            <template v-for="menu in menus" :key="menu.title">
                <li class="sidebar-menuitem">
                    <template v-if="menu?.items?.length">
                        <SidebarMenuitem :icon="menu.icon" :title="menu.title" @toggle="doToggle" />
                        <ul class="sidebar-submenu" :class="{ open: open }">
                            <template v-for="submenu in menu?.items" :key="submenu.title">
                                <li class="sidebar-menuitem sidebar-sub-menuitem">
                                    <SidebarMenuitem
                                        :icon="submenu.icon"
                                        :route-name="submenu.routeName"
                                        :title="submenu.title"
                                    />
                                </li>
                            </template>
                        </ul>
                    </template>
                    <SidebarMenuitem
                        v-else
                        :icon="menu.icon"
                        :route-name="menu.routeName"
                        :title="menu.title"
                    />
                </li>
            </template>
        </ul>
    </div>
</template>
<script setup>
import SidebarMenuitem from '@/components/SidebarMenuitem.vue'
import { ref, watch } from 'vue'
import { useRoute } from 'vue-router'

const open = ref(false)
const route = useRoute()

watch(
    () => route.name,
    name => {
        open.value = [
            'brands',
            'brands.create',
            'brands.edit',
            'models',
            'models.create',
            'models.edit',
            'features',
            'features.create',
            'features.edit',
            'cars',
            'cars.create',
            'cars.edit',
        ].includes(name)
    },
    { immediate: true }
)

const menus = [
    {
        icon: 'home',
        routeName: 'dashboard',
        title: 'Dashboard',
    },
    {
        icon: 'clock',
        routeName: 'bookings',
        title: 'Bookings',
    },
    {
        icon: 'list',
        routeName: 'units',
        title: 'Units',
        items: [
            {
                icon: 'car',
                routeName: 'cars',
                title: 'Cars',
            },
            {
                icon: 'bookmark',
                routeName: 'brands',
                title: 'Brands',
            },
            {
                icon: 'clone',
                routeName: 'models',
                title: 'Models',
            },
            {
                icon: 'sparkles',
                routeName: 'features',
                title: 'Features',
            },
        ],
    },
    {
        icon: 'calendar',
        routeName: 'calendar',
        title: 'Calendar',
    },
    {
        icon: 'users',
        routeName: 'clients',
        title: 'Clients',
    },
    {
        icon: 'cog',
        routeName: 'settings',
        title: 'Settings',
    },
    {
        icon: 'sign-out',
        routeName: 'logout',
        title: 'Logout',
    },
]

const doToggle = () => {
    open.value = !open.value
}
</script>
