<template>
    <div>
        <div class="mb-4">
            <h2 class="text-xl font-bold text-slate-950">Insurance Options</h2>

            <div class="mt-2 h-0.5 w-12 bg-[#fcb102]"></div>
        </div>

        <div class="grid gap-6 md:grid-cols-3">
            <article
                v-for="option in insuranceOptions"
                :key="option.title"
                class="relative rounded-lg border p-6 transition hover:shadow-md"
                :class="
                    option.recommended
                        ? 'border-[#fcb102] shadow-sm bg-[#fffcfa]'
                        : 'border-slate-200  bg-white'
                "
            >
                <div class="mb-6 flex items-start gap-4">
                    <div
                        class="flex h-14 w-14 shrink-0 items-center justify-center rounded-lg bg-orange-50 text-[#fcb102]"
                    >
                        <i class="pi pi-shield text-3xl"></i>
                    </div>

                    <div>
                        <div class="mb-1 flex flex-wrap items-center gap-2">
                            <h3 class="font-bold text-slate-950">
                                {{ option.title }}
                            </h3>

                            <Tag
                                v-if="option.recommended"
                                value="Recommended"
                                severity="success"
                                class="!rounded-full !px-2 !py-0.5 !text-xs"
                            />
                        </div>

                        <p class="text-sm leading-5 text-slate-600">
                            {{ option.description }}
                        </p>
                    </div>
                </div>

                <ul class="space-y-2">
                    <li
                        v-for="feature in option.features"
                        :key="feature"
                        class="flex items-center gap-2 text-sm text-slate-700"
                    >
                        <i class="pi pi-check text-xs text-slate-500"></i>
                        <span>{{ feature }}</span>
                    </li>
                </ul>

                <div
                    class="mt-8 text-right"
                    :class="option.recommended ? 'text-primary' : 'text-slate-950'"
                >
                    <span class="text-2xl font-bold"> {{ option.price }} € </span>
                    <span class="text-sm font-semibold"> / day </span>
                </div>
            </article>
        </div>

        <div class="mt-6 flex items-center justify-center gap-2 text-sm text-slate-500">
            <i class="pi pi-shield text-slate-500"></i>
            <span> All insurance options include 24/7 roadside assistance and support. </span>
        </div>
    </div>
</template>
<script setup>
import { Tag } from 'primevue'

const insuranceOptions = [
    {
        title: 'Full Coverage',
        recommended: true,
        description:
            'Our highest level of protection. Reduces your excess to €0 for covered incidents.',
        price: 10,
        features: ['Zero excess', 'Covers damage and theft', '24/7 support', 'Peace of mind'],
    },
    {
        title: 'Premium Coverage',
        recommended: false,
        description: 'Extra protection for accidental damage and theft.',
        price: 6,
        features: ['Lower excess', 'Covers damage and theft', '24/7 support'],
    },
    {
        title: 'Basic Coverage',
        recommended: false,
        description: 'Standard protection included with every rental.',
        price: 0,
        features: ['Standard excess', 'Covers damage and theft', '24/7 support'],
    },
]
</script>
