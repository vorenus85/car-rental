<template>
    <div class="layout-sidebar shadow">
        <ul class="sidebar-menu">
            <template v-for="menu in menus" :key="menu.title">
                <li class="sidebar-menuitem">
                    <template v-if="menu?.items?.length">
                        <SidebarMenuitem
                            :icon="menu.icon"
                            :title="menu.title"
                            :active="openMenu === menu.routeName"
                            @toggle="doToggle(menu.routeName)"
                        />
                        <ul class="sidebar-submenu" :class="{ open: openMenu === menu.routeName }">
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
import SidebarMenuitem from '@admin/components/SidebarMenuitem.vue'
import { onMounted, ref } from 'vue'
import { useRoute } from 'vue-router'

const route = useRoute()
const openMenu = ref(null)

const doToggle = routeName => {
    openMenu.value = openMenu.value === routeName ? null : routeName
}

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
        routeName: 'fleet',
        title: 'Fleet',
        items: [
            {
                icon: 'car',
                routeName: 'cars',
                title: 'Cars',
                parent: 'fleet',
            },
            {
                icon: 'bookmark',
                routeName: 'brands',
                title: 'Brands',
                parent: 'fleet',
            },
            {
                icon: 'th-large',
                routeName: 'models',
                title: 'Models',
                parent: 'fleet',
            },
            {
                icon: 'sliders-h',
                routeName: 'variants',
                title: 'Variants',
                parent: 'fleet',
            },
            {
                icon: 'sparkles',
                routeName: 'features',
                title: 'Features',
                parent: 'fleet',
            },
        ],
    },
    {
        icon: 'map-marker',
        routeName: 'locations',
        title: 'Locations',
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
        items: [
            {
                icon: 'user',
                routeName: 'users',
                title: 'Users',
                parent: 'settings',
            },
        ],
    },
    {
        icon: 'sign-out',
        routeName: 'logout',
        title: 'Logout',
    },
]

onMounted(() => {
    if (route?.meta?.parent) {
        openMenu.value = route?.meta?.parent
    }
})
</script>
<style scoped>
.sidebar-menu {
    display: flex;
    flex-direction: column;
    height: stretch;
}

.sidebar-menuitem:nth-last-child(1) {
    margin-top: auto;
}
</style>
