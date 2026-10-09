<template>
    <PublicLayout>
        <section class="relative overflow-hidden">
            <ServicesArticleHero
                title="Child Seats"
                intro="Add a child seat to your rental and make every family journey safer, easier, and more comfortable."
                image="/images/services/large/child-seats.webp"
            ></ServicesArticleHero>
        </section>
        <article class="container mx-auto px-6 py-12 text-slate-700">
            <div class="space-y-6 text-base leading-8">
                <p>
                    Traveling with children requires a little more planning, especially when safety
                    and comfort are involved. Whether you are heading to the airport, driving to
                    your hotel, visiting family, or planning a longer road trip, having the right
                    child seat can make the journey much easier from the very beginning.
                </p>

                <p>
                    Our child seat service is designed for families who want a simple and reliable
                    car rental experience. Instead of bringing your own seat, carrying it through
                    the airport, or trying to arrange one at the last minute, you can add a child
                    seat directly to your booking and have it ready with your rental car.
                </p>

                <p>
                    This gives you one less thing to worry about during your trip. Your vehicle can
                    be prepared for your family’s needs, helping you start the journey calmly and
                    comfortably.
                </p>

                <h2 class="pt-4 text-2xl font-bold leading-tight text-[#061324]">
                    Designed for Children Up to 12 Years Old
                </h2>

                <p>
                    Child seats are especially important for younger passengers who need extra
                    support and protection while traveling by car. Our service is suitable for
                    children up to 12 years old, depending on age, size, and travel requirements.
                </p>

                <p>
                    A properly selected child seat helps children sit more securely during the
                    journey. It also gives parents greater peace of mind, especially when driving in
                    a new location or on unfamiliar roads.
                </p>

                <h2 class="pt-4 text-2xl font-bold leading-tight text-[#061324]">
                    Easier Family Travel
                </h2>

                <p>
                    Family travel often comes with bags, strollers, documents, snacks, and plenty of
                    small details to manage. Bringing a child seat from home can be inconvenient,
                    particularly when flying or traveling with multiple children. Adding one to your
                    rental helps reduce the amount of equipment you need to carry.
                </p>

                <p>
                    This is especially useful for airport pickups, holiday rentals, weekend trips,
                    and city visits. When the car is ready with the child seat included, your family
                    can get on the road faster and with less stress.
                </p>

                <p>
                    It also makes the rental process more practical. You do not need to search for a
                    local shop, arrange a separate rental, or compromise on comfort after arrival.
                    Everything can be handled as part of your car rental booking.
                </p>

                <h2 class="pt-4 text-2xl font-bold leading-tight text-[#061324]">
                    Comfort Matters on Every Trip
                </h2>

                <p>
                    A comfortable child is a happier travel companion. Long drives, airport
                    transfers, and busy travel days are much easier when children have a secure and
                    suitable place to sit. A child seat can help make the journey feel calmer for
                    both children and adults.
                </p>

                <p>
                    Whether your trip is short or long, comfort can make a real difference. Children
                    can sit more naturally, rest more easily, and feel more settled during the
                    drive. For parents, that means fewer distractions and a more relaxed experience
                    behind the wheel.
                </p>

                <blockquote
                    class="my-8 border-l-4 border-[#fcb102] bg-slate-50 px-6 py-5 text-lg font-medium leading-8 text-[#061324]"
                >
                    A child seat is a small addition to your booking, but it can make family travel
                    safer, simpler, and much more comfortable.
                </blockquote>

                <h2 class="pt-4 text-2xl font-bold leading-tight text-[#061324]">
                    Add a Child Seat to Your Booking
                </h2>

                <p>
                    Our child seat service is a practical option for parents, families, and anyone
                    traveling with young passengers. It helps you prepare your rental car for the
                    people who matter most and makes the entire journey feel better organized.
                </p>

                <p>
                    Whether you are planning a family holiday, a city break, an airport transfer, or
                    a longer road trip, adding a child seat gives you extra convenience and peace of
                    mind.
                </p>

                <p>
                    Add a child seat to your car rental and enjoy a safer, easier, and more
                    comfortable journey with your family.
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
