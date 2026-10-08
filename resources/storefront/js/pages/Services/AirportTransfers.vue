<template>
    <PublicLayout>
        <section class="relative overflow-hidden">
            <ServicesArticleHero
                title="Airport Transfers"
                intro="Enjoy hassle-free airport pickup and drop-off with a reliable driver waiting for you when you arrive. Start or finish your journey without queues, uncertainty or unnecessary stress."
                image="/images/services/airport-transfers.webp"
            ></ServicesArticleHero>
        </section>
        <article class="container mx-auto px-6 py-12 text-slate-700">
            <div class="space-y-6 text-base leading-8">
                <p>
                    Traveling should feel exciting, not stressful. Whether you are arriving for a
                    business meeting, a family holiday, a city break, or a longer road trip, the
                    first moments after landing can shape the whole experience. Long queues,
                    confusing public transport, expensive last-minute taxis, and the pressure of
                    finding your way in an unfamiliar place can quickly turn a simple arrival into a
                    tiring start.
                </p>

                <p>
                    With our airport transfer service, your journey begins smoothly from the moment
                    you land.
                </p>

                <p>
                    We offer hassle-free pickup and drop-off at the airport, so you do not have to
                    worry about transportation after your flight. Our driver will be waiting for you
                    at the agreed time and location, ready to help you continue your trip
                    comfortably. No searching, no waiting, no uncertainty. Just a clean, reliable
                    car and a professional service designed around your schedule.
                </p>

                <h2 class="pt-4 text-2xl font-bold leading-tight text-[#061324]">
                    Why Book an Airport Transfer in Advance?
                </h2>

                <p>
                    One of the biggest advantages of booking an airport transfer in advance is peace
                    of mind. Flights can be tiring, especially after a long journey, delays, or
                    traveling with luggage. Instead of trying to arrange transport after arrival,
                    you already know that everything is prepared. Your pickup is planned, your
                    destination is known, and your car is ready.
                </p>

                <p>
                    This service is ideal for travelers who value comfort, time, and reliability. If
                    you are visiting the city for business, an airport transfer helps you stay
                    focused and arrive on time. If you are traveling with family, it makes the
                    arrival easier for everyone, especially when children, bags, or multiple
                    passengers are involved. If you are here for a holiday, it gives you a relaxed
                    start, without the usual travel stress.
                </p>

                <h2 class="pt-4 text-2xl font-bold leading-tight text-[#061324]">
                    A Simple Connection Between the Airport and Your Trip
                </h2>

                <p>
                    Our airport transfer service is also a great choice for customers who rent a car
                    and want a simple connection between the airport and their vehicle. You can
                    arrange your pickup and continue your trip with confidence, knowing that the
                    important details have already been handled. From the airport to your hotel,
                    office, apartment, or rental location, we make the process simple and
                    convenient.
                </p>

                <p>
                    We understand that travel plans can be sensitive to time. That is why
                    punctuality is an essential part of our service. Airport pickups and drop-offs
                    are arranged carefully, with attention to your arrival or departure schedule.
                    For departures, we help you reach the airport in good time, so you can check in
                    calmly and avoid unnecessary pressure. For arrivals, we make sure your transfer
                    is ready when you need it.
                </p>

                <h2 class="pt-4 text-2xl font-bold leading-tight text-[#061324]">
                    Comfortable, Reliable and Easy
                </h2>

                <p>
                    Comfort also matters. After a flight, you want a pleasant ride, enough space for
                    your luggage, and a clean vehicle that feels safe and well maintained. Our
                    airport transfer service is designed to provide exactly that. It is a practical,
                    comfortable solution for both short distances and longer transfers.
                </p>

                <p>
                    Booking an airport transfer is especially useful when you are arriving in a new
                    destination for the first time. You may not know the best route, the local
                    transport options, or the typical taxi prices. With a pre-arranged transfer, you
                    avoid guesswork and start your visit with clarity. You know who will meet you,
                    where you are going, and what to expect.
                </p>

                <p>
                    For business travelers, the service creates a professional first impression.
                    Arriving on time and without stress can make a real difference before an
                    important meeting, conference, or event. For leisure travelers, it helps
                    preserve the feeling of the trip: easy, comfortable, and enjoyable from the
                    beginning.
                </p>

                <blockquote
                    class="my-8 border-l-4 border-[#fcb102] bg-slate-50 px-6 py-5 text-lg font-medium leading-8 text-[#061324]"
                >
                    Airport transfers are not only about transportation. They are about making
                    travel simpler, calmer, and more comfortable from the very first moment.
                </blockquote>

                <p>
                    Whether you need a pickup after landing or a smooth drop-off before departure,
                    our airport transfer service is here to make your travel experience easier. Plan
                    ahead, avoid unnecessary stress, and enjoy a comfortable ride from or to the
                    airport.
                </p>

                <p>Book your airport transfer today and start your journey the easy way.</p>
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
