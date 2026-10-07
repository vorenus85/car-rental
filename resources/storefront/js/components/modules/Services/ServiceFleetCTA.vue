<script setup>
import { Button } from 'primevue'
</script>

<template>
    <div
        class="rounded-lg bg-[#061324] px-6 py-6 text-white md:bg-[url('/images/ready-road-cta-bg-1600x400.webp')] md:bg-cover md:bg-no-repeat md:bg-[center_right] md:px-8"
    >
        <div class="flex flex-col gap-5 md:flex-row md:items-center md:justify-between">
            <div class="max-w-xl">
                <h2 class="mb-2 text-2xl font-bold tracking-tight">Ready to Hit the Road?</h2>

                <p class="text-sm leading-6 text-slate-100 md:text-base">
                    Choose your car, add your extras and enjoy a seamless rental experience with
                    <span class="text-primary">DrivenGo</span>.
                </p>
            </div>

            <Button
                label="Browse Cars"
                icon="pi pi-arrow-right"
                iconPos="right"
                class="!border-0 !bg-[#fcb102] !px-6 !py-3 !font-semibold !text-slate-950 hover:!bg-[#e6a000] no-wrap"
            />
        </div>
    </div>
</template>
