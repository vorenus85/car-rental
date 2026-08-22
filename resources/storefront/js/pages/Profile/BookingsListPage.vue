<template>
    <PublicLayout class="profile-bookings-list-page">
        <div class="mx-auto max-w-8xl px-4 py-4 min-h-[500px]">
            <BreadcrumbModule :items="breadcrumbItems"></BreadcrumbModule>
            <PageTitle title="Bookings"></PageTitle>
            <div class="mb-10">
                <p class="mt-2 text-sm text-slate-500">Here you can find your bookings.</p>
            </div>
            <div class="mt-5 grid grid-cols-1 gap-8 lg:grid-cols-[280px_minmax(0,1fr)] items-start">
                <ProfileSidebar />
                <div class="mb-10">
                    <div class="w-full grid grid-cols-1 gap-4 lg:grid-cols-2">
                        <BookingListCard
                            v-for="booking in bookings"
                            :key="booking.id"
                            :item="booking"
                        ></BookingListCard>
                    </div>
                </div>
            </div>
        </div>
    </PublicLayout>
</template>
<script setup>
import PublicLayout from '@storefront/layouts/PublicLayout.vue'
import PageTitle from '@storefront/components/modules/PageTitle.vue'
import BreadcrumbModule from '@storefront/components/modules/BreadcrumbModule.vue'
import ProfileSidebar from '@storefront/components/modules/Profile/ProfileSidebar.vue'
import BookingListCard from '@storefront/components/modules/Profile/BookingList/BookingListCard.vue'
import { useProfileBookings } from '@storefront/composables/useProfileBookings'
import { onMounted } from 'vue'

const { getCustomerBookings, bookings } = useProfileBookings()

const breadcrumbItems = [
    {
        label: 'Profile',
        route: '/profile',
    },
    {
        label: 'Bookings',
    },
]

onMounted(async () => {
    await getCustomerBookings()
})
</script>
