<template>
    <PublicLayout>
        <section class="relative overflow-hidden">
            <ServicesArticleHero
                title="Roadside Assistance"
                intro="Travel with confidence knowing that 24/7 support is available in case of breakdowns,
                tire issues, or unexpected situations."
                image="/images/services/large/roadside-assistance.webp"
            ></ServicesArticleHero>
        </section>
        <article class="container mx-auto px-6 py-12 text-slate-700">
            <div class="space-y-6 text-base leading-8">
                <p>
                    Even the best-planned journey can bring unexpected moments. A flat tire, a
                    warning light, a dead battery, or a mechanical issue can quickly turn a
                    comfortable trip into a stressful situation. With our roadside assistance
                    service, you do not have to face these problems alone.
                </p>

                <p>
                    Roadside assistance gives you extra peace of mind throughout your rental period.
                    Whether you are driving in the city, heading to the airport, exploring the
                    countryside, or traveling between destinations, support is available if
                    something goes wrong on the road.
                </p>

                <p>
                    Our goal is simple: to help you continue your journey as safely and smoothly as
                    possible. When an unexpected issue happens, you can contact support and get
                    guidance on the next steps. Instead of trying to solve the problem alone, you
                    have a reliable service behind you.
                </p>

                <h2 class="pt-4 text-2xl font-bold leading-tight text-[#061324]">
                    Confidence on Every Journey
                </h2>

                <p>
                    Renting a car should feel convenient, flexible, and secure. Roadside assistance
                    adds an extra layer of protection to your trip, especially when you are driving
                    in an unfamiliar area. You may not know local repair services, nearby fuel
                    stations, or the safest way to handle a roadside problem. Having assistance
                    available makes the situation easier to manage.
                </p>

                <p>
                    This service is especially valuable for longer journeys, airport transfers,
                    business trips, family holidays, and road trips where reliability matters. It
                    helps reduce stress and gives you the confidence to focus on your destination
                    instead of worrying about what might happen along the way.
                </p>

                <h2 class="pt-4 text-2xl font-bold leading-tight text-[#061324]">
                    Help for Common Roadside Problems
                </h2>

                <p>
                    Roadside issues can happen for many reasons, and they are not always
                    predictable. A tire can lose pressure, a battery can fail, or a vehicle may need
                    technical attention. In these moments, fast and clear support makes a real
                    difference.
                </p>

                <p>
                    With roadside assistance, you can get help in case of breakdowns, tire problems,
                    and other unexpected situations during your rental. The service is designed to
                    guide you through the problem and help arrange the right solution based on the
                    situation.
                </p>

                <p>
                    Instead of losing time searching for help, you can rely on an organized support
                    process. That means less uncertainty, less pressure, and a safer experience for
                    everyone traveling with you.
                </p>

                <h2 class="pt-4 text-2xl font-bold leading-tight text-[#061324]">
                    Ideal for Stress-Free Car Rental
                </h2>

                <p>
                    Roadside assistance is a smart choice for any traveler who wants extra
                    reassurance. If you are visiting a new place, driving long distances, or
                    traveling with family, knowing that help is available can make the whole rental
                    experience feel much more comfortable.
                </p>

                <p>
                    It is also useful for business travelers who cannot afford unnecessary delays.
                    When your schedule is important, having support in place helps you respond
                    quickly if something unexpected happens. For holiday travelers, it helps protect
                    the relaxed feeling of the trip, even when the road brings a small surprise.
                </p>

                <blockquote
                    class="my-8 border-l-4 border-[#fcb102] bg-slate-50 px-6 py-5 text-lg font-medium leading-8 text-[#061324]"
                >
                    Roadside assistance is not just about solving problems. It is about knowing that
                    support is there before you ever need it.
                </blockquote>

                <h2 class="pt-4 text-2xl font-bold leading-tight text-[#061324]">
                    Drive With Extra Peace of Mind
                </h2>

                <p>
                    Every trip should be about the journey, the destination, and the freedom to
                    travel at your own pace. Roadside assistance helps protect that experience by
                    giving you a dependable support option throughout your rental.
                </p>

                <p>
                    Whether you are planning a short city drive, a long-distance route, a weekend
                    escape, or a full road trip, this service helps you feel prepared. You can drive
                    knowing that if something unexpected happens, you have a clear way to get help.
                </p>

                <p>
                    Add roadside assistance to your rental and enjoy every journey with greater
                    confidence, comfort, and peace of mind.
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
