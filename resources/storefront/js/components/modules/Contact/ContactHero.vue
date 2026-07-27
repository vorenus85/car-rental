<template>
    <!-- Background image -->
    <div
        class="absolute inset-0 bg-cover bg-center"
        style="background-image: url('/images/contact_hero.webp')"
    >
        <!-- Dark overlay -->
        <div class="absolute inset-0 bg-[#061324]/60"></div>

        <!-- Left gradient -->
        <div
            class="absolute inset-y-0 left-0 w-2/3 bg-gradient-to-r from-[#061324]/95 via-[#061324]/70 to-transparent"
        ></div>
    </div>

    <!-- Content -->
    <div class="relative z-10 container mx-auto px-6">
        <div class="flex min-h-[520px] items-center">
            <div class="max-w-xl">
                <span
                    class="inline-flex items-center gap-2 text-[#fcb102] uppercase tracking-widest text-xs font-semibold"
                >
                    <span class="w-8 h-px bg-[#fcb102]"></span>
                    Contact Us
                </span>

                <h1 class="mt-5 text-5xl lg:text-7xl font-extrabold leading-tight text-white">
                    We're Here
                    <br />

                    <span class="text-[#fcb102]"> To Help You. </span>
                </h1>

                <p class="mt-6 text-lg leading-8 text-white/80 max-w-lg">
                    Have questions or need assistance? Our team is ready to help you with anything
                    you need, from reservations to rental support.
                </p>

                <div class="mt-10 flex flex-wrap gap-4">
                    <a
                        href="#contact-form"
                        class="inline-flex items-center rounded-lg bg-[#fcb102] px-8 py-4 font-semibold text-[#061324] transition hover:bg-yellow-400"
                    >
                        Contact Us

                        <i class="pi pi-arrow-right ml-3"></i>
                    </a>

                    <a
                        href="tel:+3612345678"
                        class="inline-flex items-center rounded-lg border border-white/20 bg-white/10 px-8 py-4 font-semibold text-white backdrop-blur transition hover:bg-white/20"
                    >
                        <i class="pi pi-phone mr-3"></i>

                        +36 1 234 5678
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>
