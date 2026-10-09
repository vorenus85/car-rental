<template>
    <PublicLayout>
        <section class="relative overflow-hidden">
            <ServicesArticleHero
                title="Additional Drivers"
                intro="Add another driver to your rental and make every trip more flexible, comfortable, and relaxed."
                image="/images/services/large/additional-drivers.webp"
            ></ServicesArticleHero>
        </section>
        <article class="container mx-auto px-6 py-12 text-slate-700">
            <div class="space-y-6 text-base leading-8">
                <p>
                    Long drives, busy schedules, and unfamiliar roads can make travel more demanding
                    than expected. With our additional driver service, you do not have to handle the
                    entire journey alone. By adding another approved driver to your rental, you can
                    share the driving and enjoy a smoother, safer, and more comfortable travel
                    experience.
                </p>

                <p>
                    This option is especially useful for longer trips, family holidays, business
                    travel, road trips, and any journey where flexibility matters. Instead of one
                    person being responsible for every mile, another driver can take over when
                    needed. That means more rest, less pressure, and a more enjoyable trip for
                    everyone in the car.
                </p>

                <p>
                    Whether you are traveling with a partner, colleague, friend, or family member,
                    adding an additional driver gives your rental more freedom. Plans can change,
                    routes can be longer than expected, and travel days can become tiring. Having
                    another driver available helps you stay comfortable and in control from start to
                    finish.
                </p>

                <h2 class="pt-4 text-2xl font-bold leading-tight text-[#061324]">
                    A More Relaxed Way to Travel
                </h2>

                <p>
                    Driving should not feel like a burden, especially when the purpose of your trip
                    is to enjoy your destination. With an additional driver, you can take breaks
                    when you need them, switch drivers on longer routes, or simply share the
                    responsibility of getting from one place to another.
                </p>

                <p>
                    This can make a big difference during road trips, airport journeys, weekend
                    escapes, and holidays with multiple stops. One person can drive while the other
                    rests, navigates, answers messages, or simply enjoys the view. It makes the
                    journey feel easier and less rushed.
                </p>

                <h2 class="pt-4 text-2xl font-bold leading-tight text-[#061324]">
                    Ideal for Longer Routes and Busy Travel Days
                </h2>

                <p>
                    If your journey includes long distances, early departures, late arrivals, or
                    several destinations, adding another driver is a smart choice. Travel fatigue
                    can build up quickly, especially when one person is driving for many hours.
                    Sharing the drive helps reduce tiredness and keeps the journey more comfortable.
                </p>

                <p>
                    It is also practical for business trips, where schedules can be tight and plans
                    may change during the day. If one driver is unavailable, tired, or needs to
                    focus on work, another approved driver can take the wheel. That extra
                    flexibility can make the whole rental experience easier to manage.
                </p>

                <p>
                    For families, couples, and groups, this service adds another layer of
                    convenience. Everyone can travel with more peace of mind, knowing that the
                    driving does not depend on just one person.
                </p>

                <h2 class="pt-4 text-2xl font-bold leading-tight text-[#061324]">
                    Simple, Practical and Convenient
                </h2>

                <p>
                    Adding an additional driver is a simple way to make your rental more useful.
                    Once the extra driver is approved and added to the booking, they can legally
                    share the driving during the rental period. This keeps everything clear,
                    properly arranged, and covered according to the rental conditions.
                </p>

                <p>
                    It is a small upgrade that can make a major difference, especially when your
                    trip involves more than a short city drive. Instead of planning every route
                    around one driver’s energy and availability, you can travel with more balance
                    and flexibility.
                </p>

                <blockquote
                    class="my-8 border-l-4 border-[#fcb102] bg-slate-50 px-6 py-5 text-lg font-medium leading-8 text-[#061324]"
                >
                    Additional drivers help turn a demanding journey into a shared experience,
                    making the road feel easier for everyone.
                </blockquote>

                <h2 class="pt-4 text-2xl font-bold leading-tight text-[#061324]">
                    Share the Driving, Enjoy More of the Trip
                </h2>

                <p>
                    Car rental is not only about getting a vehicle. It is about making travel
                    easier, more comfortable, and better suited to your plans. Our additional driver
                    service gives you the freedom to share the responsibility and enjoy the journey
                    with less stress.
                </p>

                <p>
                    Whether you are heading out on a long road trip, traveling between cities,
                    attending business meetings, or planning a family holiday, adding another driver
                    can help you make the most of your rental. You can rest when you need to, keep
                    your schedule flexible, and arrive feeling more relaxed.
                </p>

                <p>
                    Add an additional driver to your booking and enjoy a more comfortable way to
                    travel together.
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
