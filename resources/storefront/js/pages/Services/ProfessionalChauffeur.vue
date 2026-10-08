<template>
    <PublicLayout>
        <section class="relative overflow-hidden">
            <ServicesArticleHero
                title="Professional Chauffeur"
                intro="Enjoy a comfortable, professional chauffeur service for any occasion, from business travel to special events."
                image="/images/services/professional-chauffeur.webp"
            ></ServicesArticleHero>
        </section>
        <article class="container mx-auto px-6 py-12 text-slate-700">
            <div class="space-y-6 text-base leading-8">
                <p>
                    Sometimes the best way to travel is to sit back, relax, and let someone else
                    take care of the road. With our professional chauffeur service, you can enjoy a
                    smooth and comfortable journey without worrying about traffic, parking,
                    navigation, or timing.
                </p>

                <p>
                    This service is ideal for customers who want more than a standard car rental.
                    Whether you are traveling for business, attending an event, arriving at the
                    airport, or planning a special occasion, a professional chauffeur adds comfort,
                    convenience, and a premium feeling to your journey.
                </p>

                <p>
                    Instead of focusing on the route, you can focus on your meeting, your guests,
                    your schedule, or simply the experience itself. Your driver handles the journey
                    while you enjoy the ride.
                </p>

                <h2 class="pt-4 text-2xl font-bold leading-tight text-[#061324]">
                    A Comfortable Service for Business Travel
                </h2>

                <p>
                    For business travelers, time and presentation matter. A professional chauffeur
                    helps you arrive calm, prepared, and on schedule. You can review notes, answer
                    messages, make calls, or relax before an important meeting while your driver
                    takes care of the road.
                </p>

                <p>
                    This service is especially useful for airport pickups, client visits,
                    conferences, corporate events, and busy travel days with multiple stops. It
                    offers a more polished and efficient way to move between destinations.
                </p>

                <h2 class="pt-4 text-2xl font-bold leading-tight text-[#061324]">
                    Perfect for Special Occasions
                </h2>

                <p>
                    A chauffeur service can also make special moments feel more refined and
                    effortless. Whether you are attending a wedding, celebration, dinner, concert,
                    or private event, having a professional driver allows you to enjoy the occasion
                    without thinking about logistics.
                </p>

                <p>
                    You do not need to search for parking, plan the return drive, or manage busy
                    city traffic. The journey becomes part of the experience: comfortable, calm, and
                    well organized from start to finish.
                </p>

                <p>
                    It is also a practical choice when traveling with guests. A professional
                    chauffeur creates a welcoming first impression and helps make the entire trip
                    feel more carefully arranged.
                </p>

                <h2 class="pt-4 text-2xl font-bold leading-tight text-[#061324]">
                    Less Stress, More Convenience
                </h2>

                <p>
                    Driving in an unfamiliar city can be stressful, especially when you are dealing
                    with traffic, directions, parking rules, or tight schedules. With a chauffeur,
                    those details are handled for you. You can travel comfortably while your driver
                    focuses on getting you to your destination.
                </p>

                <p>
                    This makes the service useful for both local travel and visitors arriving from
                    another city or country. Whether you need transport from the airport, between
                    hotels, to a business venue, or to a special event, chauffeur service gives you
                    a simple and reliable solution.
                </p>

                <blockquote
                    class="my-8 border-l-4 border-[#fcb102] bg-slate-50 px-6 py-5 text-lg font-medium leading-8 text-[#061324]"
                >
                    A professional chauffeur turns travel time into comfortable time, helping you
                    arrive relaxed, focused, and ready.
                </blockquote>

                <h2 class="pt-4 text-2xl font-bold leading-tight text-[#061324]">
                    Book a Chauffeur for Your Next Journey
                </h2>

                <p>
                    Our professional chauffeur service is designed for customers who value comfort,
                    reliability, and a higher level of convenience. It is a smart choice for
                    business trips, airport transfers, private events, formal occasions, and any
                    journey where you want the experience to feel easier and more refined.
                </p>

                <p>
                    With a professional driver behind the wheel, you can enjoy the road without the
                    responsibility of driving. Every detail is simpler, from pickup to arrival.
                </p>

                <p>
                    Add a professional chauffeur to your booking and enjoy a relaxed, comfortable,
                    and seamless travel experience.
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
