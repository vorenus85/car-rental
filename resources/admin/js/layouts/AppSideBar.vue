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
        icon: 'list',
        routeName: 'rentals',
        title: 'Rentals',
        items: [
            {
                icon: 'calendar',
                routeName: 'calendar',
                title: 'Calendar',
                parent: 'rentals',
            },
            {
                icon: 'clock',
                routeName: 'bookings',
                title: 'Bookings',
                parent: 'rentals',
            },
            {
                icon: 'list',
                routeName: 'activeRentals',
                title: 'Active Rentals',
                parent: 'rentals',
            },
            {
                icon: 'list',
                routeName: 'upcomingRentals',
                title: 'Upcoming Rentals',
                parent: 'rentals',
            },
            {
                icon: 'list',
                routeName: 'pendingRentals',
                title: 'Pending Rentals',
                parent: 'rentals',
            },
            {
                icon: 'list',
                routeName: 'overdueRentals',
                title: 'Overdue Rentals',
                parent: 'rentals',
            },
        ],
    },
    {
        icon: 'users',
        routeName: 'customers',
        title: 'Customers',
    },
    {
        icon: 'id-card',
        routeName: 'carDrivers',
        title: 'Car Drivers',
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
        icon: 'list',
        routeName: 'services',
        title: 'Services',
        items: [
            {
                icon: 'plus-circle',
                routeName: 'extras',
                title: 'Extras',
                parent: 'services',
            },

            {
                icon: 'shield',
                routeName: 'insurances',
                title: 'Insurances',
                parent: 'services',
            },
        ],
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
