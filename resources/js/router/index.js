import { createRouter, createWebHistory } from 'vue-router'

import DashboardPage from '@/pages/DashboardPage.vue'
import BookingsPage from '@/pages/BookingsPage.vue'
import UnitsPage from '@/pages/UnitsPage.vue'
import CalendarPage from '@/pages/CalendarPage.vue'
import ClientsPage from '@/pages/ClientsPage.vue'
import SettingsPage from '@/pages/SettingsPage.vue'

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/', name: 'dashboard', component: DashboardPage },
        { path: '/bookings', name: 'bookings', component: BookingsPage },
        { path: '/units', name: 'units', component: UnitsPage },
        { path: '/calendar', name: 'calendar', component: CalendarPage },
        { path: '/clients', name: 'clients', component: ClientsPage },
        { path: '/settings', name: 'settings', component: SettingsPage },
        {
            path: '/logout',
            name: 'logout',
            meta: { requiresAuth: true },
        },
    ],
})

export default router
