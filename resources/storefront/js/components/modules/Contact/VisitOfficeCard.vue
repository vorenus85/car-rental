<template>
    <div class="rounded-3xl bg-white p-10 shadow-2xl">
        <h2 class="text-4xl font-extrabold text-[#061324]">Visit Our Office</h2>

        <p class="mt-5 leading-8 text-slate-600">
            We'd love to meet you in person. Find us at our office location.
        </p>

        <div class="mt-5 mb-4 flex gap-5">
            <div class="flex h-16 w-16 items-center justify-center rounded-full bg-[#fcb102]/10">
                <i class="pi pi-map-marker text-3xl text-[#fcb102]"></i>
            </div>

            <div>
                <div class="space-y-1 text-lg leading-8 text-[#061324]">
                    <p>
                        1062 Budapest<br />

                        Váci Road 1-3<br />

                        Hungary
                    </p>
                </div>
            </div>
        </div>

        <Button
            as="a"
            target="_blank"
            href="https://www.google.com/maps/search/?api=1&query=Westend+City+Center,+1062+Budapest,+Váci+út+1-3"
            label="Get Directions"
            icon="pi pi-send"
            icon-pos="right"
            class="w-full sm:w-50"
        />
    </div>
</template>
<script setup>
import { Button } from 'primevue'
</script>
