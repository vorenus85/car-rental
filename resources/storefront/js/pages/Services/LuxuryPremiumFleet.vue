<template>
    <PublicLayout>
        <section class="relative overflow-hidden">
            <ServicesArticleHero
                title="Luxury & Premium Fleet"
                intro="Experience comfort, elegance, and refined performance with our selection of luxury and premium vehicles."
                image="/images/services/large/luxury-premium-fleet.webp"
            ></ServicesArticleHero>
        </section>
        <article class="container mx-auto px-6 py-12 text-slate-700">
            <div class="space-y-6 text-base leading-8">
                <p>
                    Some journeys call for more than simple transportation. Whether you are
                    traveling for business, celebrating a special occasion, welcoming important
                    guests, or simply want a more comfortable driving experience, our luxury and
                    premium fleet gives you a refined way to travel.
                </p>

                <p>
                    Premium vehicles are designed to make every trip feel smoother, quieter, and
                    more enjoyable. From elegant interiors and advanced features to a more confident
                    driving experience, choosing a luxury rental adds an extra level of comfort and
                    style to your journey.
                </p>

                <p>It is the ideal choice when presentation, comfort, and experience matter.</p>

                <h2 class="pt-4 text-2xl font-bold leading-tight text-[#061324]">
                    A Better Experience for Business Travel
                </h2>

                <p>
                    For business travelers, the right vehicle can make a strong impression. Arriving
                    in a premium car helps create a professional image, whether you are meeting
                    clients, attending a conference, visiting partners, or traveling between
                    important appointments.
                </p>

                <p>
                    A luxury vehicle also gives you a more comfortable space between destinations.
                    You can enjoy a calm ride, focus before a meeting, or simply make a busy travel
                    day feel less tiring.
                </p>

                <h2 class="pt-4 text-2xl font-bold leading-tight text-[#061324]">
                    Perfect for Special Occasions
                </h2>

                <p>
                    Luxury and premium rentals are also a great choice for weddings, anniversaries,
                    private events, weekend getaways, and memorable celebrations. The vehicle
                    becomes part of the experience, adding elegance and a sense of occasion to the
                    day.
                </p>

                <p>
                    Whether you are planning a formal event or a relaxed premium escape, choosing
                    the right car can make the journey feel more special from the very first moment.
                </p>

                <h2 class="pt-4 text-2xl font-bold leading-tight text-[#061324]">
                    Comfort, Style and Confidence
                </h2>

                <p>
                    Our luxury and premium fleet is selected for customers who value quality. These
                    vehicles offer a higher level of comfort, modern features, smooth handling, and
                    a more refined atmosphere inside the cabin.
                </p>

                <p>
                    This makes them suitable for both drivers and passengers. Whether you are behind
                    the wheel or enjoying the ride, a premium car can turn an ordinary journey into
                    something more enjoyable and memorable.
                </p>

                <blockquote
                    class="my-8 border-l-4 border-[#fcb102] bg-slate-50 px-6 py-5 text-lg font-medium leading-8 text-[#061324]"
                >
                    A premium vehicle is not only about getting somewhere. It is about enjoying the
                    journey with greater comfort, elegance, and confidence.
                </blockquote>

                <h2 class="pt-4 text-2xl font-bold leading-tight text-[#061324]">
                    Choose a Premium Vehicle for Your Next Trip
                </h2>

                <p>
                    Whether you need a stylish car for business, a luxury vehicle for an event, or a
                    more comfortable option for a longer journey, our premium fleet gives you a
                    flexible and elegant solution.
                </p>

                <p>
                    Travel with comfort, arrive with confidence, and enjoy the road in a vehicle
                    that fits the occasion.
                </p>

                <p>
                    Choose from our luxury and premium fleet and make your next journey feel
                    exceptional.
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
