<template>
    <div class="layout-sidebar shadow">
        <ul class="sidebar-menu">
            <template v-for="menu in menus" :key="menu.title">
                <SidebarMenuitem
                    :icon="menu.icon"
                    :route-name="menu.routeName"
                    :title="menu.title"
                />
            </template>
        </ul>
    </div>
</template>
<script setup>
import SidebarMenuitem from '@/components/SidebarMenuitem.vue'

const menus = [
    {
        icon: 'home',
        routeName: 'dashboard',
        title: 'Dashboard',
    },
    {
        icon: 'bookmark',
        routeName: 'bookings',
        title: 'Bookings',
    },
    {
        icon: 'car',
        routeName: 'units',
        title: 'Units',
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
</script>
