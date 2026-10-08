<template>
    <PublicLayout>
        <section class="relative overflow-hidden">
            <ServicesArticleHero
                title="Corporate Solutions"
                intro="Tailored rental solutions for businesses with flexible terms, reliable vehicles, and great benefits."
                image="/images/services/corporate-solutions.webp"
            ></ServicesArticleHero>
        </section>
        <article class="container mx-auto px-6 py-12 text-slate-700">
            <div class="space-y-6 text-base leading-8">
                <p>
                    Business travel needs to be efficient, reliable, and easy to manage. Whether
                    your company needs vehicles for daily operations, client meetings, employee
                    travel, airport transfers, or longer-term projects, our corporate car rental
                    solutions are designed to support your business with flexibility and confidence.
                </p>

                <p>
                    Instead of relying on one-size-fits-all rental options, corporate solutions give
                    your business a more practical way to organize transport. You can choose rental
                    terms, vehicle types, and service options that better match your company’s
                    schedule, budget, and travel requirements.
                </p>

                <p>
                    This makes business mobility simpler, more predictable, and easier to scale as
                    your needs change.
                </p>

                <h2 class="pt-4 text-2xl font-bold leading-tight text-[#061324]">
                    Flexible Terms for Business Travel
                </h2>

                <p>
                    Every company works differently. Some businesses need cars for a few days each
                    month, while others need regular access to vehicles for ongoing operations.
                    Corporate rental solutions can be tailored to different use cases, from short
                    business trips to longer rental periods.
                </p>

                <p>
                    Flexible terms help your company avoid unnecessary complexity. You can arrange
                    vehicles when they are needed, adjust rental periods, and select services that
                    support your team’s real workflow. This is especially useful for growing
                    businesses, project-based work, seasonal demand, and companies with changing
                    travel schedules.
                </p>

                <h2 class="pt-4 text-2xl font-bold leading-tight text-[#061324]">
                    Reliable Vehicles for Professional Use
                </h2>

                <p>
                    For business customers, reliability matters. A rental vehicle is not just a way
                    to get from one place to another. It can be part of your daily operations, your
                    customer experience, and your professional image.
                </p>

                <p>
                    Our corporate solutions help businesses access clean, comfortable, and
                    well-maintained vehicles suitable for a wide range of professional needs.
                    Whether your team needs compact cars for city travel, larger vehicles for longer
                    routes, or premium options for client-facing occasions, corporate rental can
                    provide a practical solution.
                </p>

                <p>
                    This helps your employees travel with confidence and allows your business to
                    present itself professionally wherever the road takes you.
                </p>

                <h2 class="pt-4 text-2xl font-bold leading-tight text-[#061324]">
                    Easier Planning and Better Control
                </h2>

                <p>
                    Managing business travel can become time-consuming when every trip is handled
                    separately. Corporate car rental solutions help make planning more organized by
                    giving your company a clearer and more consistent rental process.
                </p>

                <p>
                    This can be useful for finance teams, office managers, operations teams, and
                    business owners who want predictable arrangements and fewer last-minute
                    decisions. With a tailored rental setup, your company can save time and keep
                    transport planning under better control.
                </p>

                <p>
                    Corporate solutions can also support employee mobility without the long-term
                    commitment of owning or maintaining a company fleet. This gives your business
                    more flexibility while still providing access to reliable transport when it is
                    needed.
                </p>

                <blockquote
                    class="my-8 border-l-4 border-[#fcb102] bg-slate-50 px-6 py-5 text-lg font-medium leading-8 text-[#061324]"
                >
                    Corporate car rental gives businesses a flexible way to stay mobile without the
                    pressure of managing a full fleet.
                </blockquote>

                <h2 class="pt-4 text-2xl font-bold leading-tight text-[#061324]">
                    A Smart Solution for Growing Companies
                </h2>

                <p>
                    Whether your company is small, growing, or already managing regular travel
                    needs, corporate rental solutions can help you move more efficiently. They are
                    suitable for sales teams, consultants, visiting executives, event teams, project
                    managers, and businesses that need flexible vehicle access without unnecessary
                    complications.
                </p>

                <p>
                    You can support your team, serve your clients, and handle travel requirements
                    with a service designed around business needs.
                </p>

                <p>
                    Contact us to learn more about our corporate solutions and discover how flexible
                    car rental can support your company’s everyday mobility.
                </p>
            </div>
        </article>
        <section class="relative z-10 px-4">
            <div class="container mx-auto px-6 py-7">
                <ServiceFleetCTA></ServiceFleetCTA>
            </div>
        </section>
    </PublicLayout>
</template>

<script setup>
import PublicLayout from '@storefront/layouts/PublicLayout.vue'
import ServicesArticleHero from '@storefront/components/modules/Services/ServicesArticleHero.vue'
import ServiceFleetCTA from '@storefront/components/modules/Services/ServiceFleetCTA.vue'
</script>
