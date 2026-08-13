<template>
    <aside class="w-full lg:w-72">
        <div class="rounded bg-white p-4 shadow-sm ring-1 ring-slate-200">
            <p class="px-3 pb-3 text-sm font-semibold uppercase tracking-[0.2em]">Profile</p>

            <nav class="flex flex-col gap-2">
                <RouterLink
                    v-for="item in menuItems"
                    :key="item.to"
                    v-slot="{ href, navigate, isExactActive }"
                    :to="item.to"
                    custom
                >
                    <a
                        :href="href"
                        class="flex items-center justify-between rounded-lg px-3 py-3 text-sm font-medium transition-colors"
                        :class="
                            isExactActive
                                ? 'bg-[var(--primary-color)] text-white shadow-sm'
                                : 'bg-slate-50 text-slate-700 hover:bg-slate-100'
                        "
                        @click="navigate"
                    >
                        <span>{{ item.label }}</span>
                    </a>
                </RouterLink>
            </nav>
        </div>
    </aside>
</template>

<script setup>
const menuItems = [
    {
        label: 'Basic details',
        to: '/profile/basic-details',
    },
    {
        label: 'Password',
        to: '/profile/password',
    },
    {
        label: 'Billing Info',
        to: '/profile/billing-info',
    },
]
</script>
