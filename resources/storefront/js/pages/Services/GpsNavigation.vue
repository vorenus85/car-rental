<template>
    <PublicLayout>
        <section class="relative overflow-hidden">
            <ServicesArticleHero
                title="GPS Navigation"
                intro="Stay on track with up-to-date maps, clear routes, and reliable voice guidance throughout your journey."
                image="/images/services/large/gps-navigation.webp"
            ></ServicesArticleHero>
        </section>
        <article class="container mx-auto px-6 py-12 text-slate-700">
            <div class="space-y-6 text-base leading-8">
                <p>
                    Exploring a new city or driving through unfamiliar roads can be exciting, but it
                    can also be stressful without reliable directions. With GPS navigation added to
                    your rental, you can travel with more confidence from the moment you start the
                    engine.
                </p>

                <p>
                    GPS navigation helps you find the best route, avoid unnecessary detours, and
                    reach your destination more easily. Whether you are driving to a hotel, airport,
                    business meeting, tourist attraction, or another city, having clear guidance
                    makes every journey simpler.
                </p>

                <p>
                    Instead of constantly checking your phone or trying to follow road signs in an
                    unfamiliar area, you can rely on easy-to-follow navigation support. This keeps
                    your attention on the road and helps make the drive safer, calmer, and more
                    comfortable.
                </p>

                <h2 class="pt-4 text-2xl font-bold leading-tight text-[#061324]">
                    Clear Directions for Every Trip
                </h2>

                <p>
                    GPS navigation is especially useful when your trip includes multiple stops,
                    airport transfers, city driving, or longer routes between destinations. It gives
                    you step-by-step directions and helps you understand where to go before every
                    turn.
                </p>

                <p>
                    Reliable voice guidance can make driving easier, especially in busy traffic or
                    when you need to stay focused. You do not have to look down repeatedly or guess
                    which road to take next. The system helps guide you along the route, so you can
                    enjoy a smoother driving experience.
                </p>

                <h2 class="pt-4 text-2xl font-bold leading-tight text-[#061324]">
                    Perfect for New Destinations
                </h2>

                <p>
                    When you are visiting a place for the first time, even simple routes can feel
                    complicated. Road names, traffic patterns, one-way streets, parking areas, and
                    exits may be unfamiliar. GPS navigation helps reduce that uncertainty by giving
                    you a clearer view of the journey ahead.
                </p>

                <p>
                    This service is ideal for tourists, business travelers, families, and anyone who
                    wants to avoid confusion on the road. It helps you move between locations with
                    less stress and more control over your time.
                </p>

                <p>
                    For longer road trips, GPS navigation can also help you plan your route more
                    comfortably. You can follow the road ahead, adjust your journey when needed, and
                    avoid losing time because of wrong turns.
                </p>

                <h2 class="pt-4 text-2xl font-bold leading-tight text-[#061324]">
                    Less Stress, More Freedom
                </h2>

                <p>
                    A rental car gives you the freedom to travel at your own pace. GPS navigation
                    makes that freedom easier to enjoy. You can explore new places, take scenic
                    routes, visit nearby attractions, or drive between cities without worrying about
                    getting lost.
                </p>

                <p>
                    It is also a practical choice when traveling with family or colleagues. Everyone
                    can relax more when the route is clear and the driver has reliable guidance. The
                    journey becomes less about finding the way and more about enjoying the
                    experience.
                </p>

                <blockquote
                    class="my-8 border-l-4 border-[#fcb102] bg-slate-50 px-6 py-5 text-lg font-medium leading-8 text-[#061324]"
                >
                    GPS navigation helps turn unfamiliar roads into simple, manageable routes, so
                    you can focus on the journey.
                </blockquote>

                <h2 class="pt-4 text-2xl font-bold leading-tight text-[#061324]">
                    Add GPS Navigation to Your Rental
                </h2>

                <p>
                    Whether you are planning a short city drive, an airport pickup, a business trip,
                    or a longer road journey, GPS navigation is a useful addition to your rental. It
                    helps you save time, reduce stress, and travel with greater confidence.
                </p>

                <p>
                    With up-to-date maps and reliable voice guidance, you can stay on track from the
                    first mile to the final destination.
                </p>

                <p>
                    Add GPS navigation to your booking and enjoy a smoother, easier, and more
                    confident driving experience.
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
