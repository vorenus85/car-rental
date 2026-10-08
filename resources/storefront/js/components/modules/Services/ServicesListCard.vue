<template>
    <article
        v-for="service in services"
        :key="service.title"
        class="group overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm transition hover:shadow-md"
    >
        <RouterLink v-if="service.link" v-slot="{ href, navigate }" :to="service.link" custom>
            <a
                :href="href"
                class="md:h-40 block h-60 overflow-hidden bg-slate-200"
                @click="navigate"
            >
                <img
                    :src="`/images/services/${service.img}.webp`"
                    :alt="service.title"
                    class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105"
                />
            </a>
        </RouterLink>
        <a v-else href="#" class="md:h-40 block h-60 overflow-hidden bg-slate-200">
            <img
                :src="`/images/services/${service.img}.webp`"
                :alt="service.title"
                class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105"
            />
        </a>

        <div class="relative px-5 pb-5 pt-8">
            <div
                class="absolute -top-7 left-5 flex h-14 w-14 items-center justify-center rounded-full border border-slate-200 bg-white text-[#f5a000] shadow-sm"
            >
                <i :class="service.icon" class="text-xl"></i>
            </div>

            <h3 class="mb-3 text-lg font-bold">
                <RouterLink
                    v-if="service.link"
                    v-slot="{ href, navigate }"
                    :to="service.link"
                    custom
                >
                    <a
                        :href="href"
                        class="text-slate-950 transition hover:text-[#f5a000]"
                        @click="navigate"
                    >
                        {{ service.title }}
                    </a>
                </RouterLink>
                <a v-else href="#" class="text-slate-950 transition hover:text-[#f5a000]">
                    {{ service.title }}
                </a>
            </h3>

            <p class="mb-5 text-sm leading-6 text-slate-700">
                {{ service.description }}
            </p>

            <RouterLink v-if="service.link" v-slot="{ href, navigate }" :to="service.link" custom>
                <a
                    :href="href"
                    class="inline-flex items-center gap-2 text-sm font-semibold text-[#f5a000] transition hover:text-[#d88a00]"
                    @click="navigate"
                >
                    Learn more
                    <i class="pi pi-arrow-right text-xs"></i>
                </a>
            </RouterLink>
            <a
                v-else
                href="#"
                class="inline-flex items-center gap-2 text-sm font-semibold text-[#f5a000] transition hover:text-[#d88a00]"
            >
                Learn more
                <i class="pi pi-arrow-right text-xs"></i>
            </a>
        </div>
    </article>
</template>
<script setup>
defineProps({
    services: {
        type: Array,
        required: true,
    },
})
</script>
