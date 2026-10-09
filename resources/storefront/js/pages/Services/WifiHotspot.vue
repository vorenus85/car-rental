<template>
    <PublicLayout>
        <section class="relative overflow-hidden">
            <ServicesArticleHero
                title="Wi-Fi Hotspot"
                intro="Add a Wi-Fi hotspot to your rental and enjoy high-speed internet for your devices wherever the road takes you."
                image="/images/services/large/wifi-hotspot.webp"
            ></ServicesArticleHero>
        </section>
        <article class="container mx-auto px-6 py-12 text-slate-700">
            <div class="space-y-6 text-base leading-8">
                <p>
                    Staying connected while traveling is no longer just a convenience. It can be
                    essential for navigation, communication, work, entertainment, and sharing your
                    journey with others. With our Wi-Fi hotspot service, you can enjoy reliable
                    internet access during your rental and keep your devices connected on the go.
                </p>

                <p>
                    Whether you are traveling for business, going on holiday, driving with family,
                    or exploring a new destination, a Wi-Fi hotspot makes the journey easier and
                    more comfortable. You can connect your phone, tablet, laptop, or other devices
                    without depending only on mobile data or public networks.
                </p>

                <p>
                    It is a simple upgrade that can make a big difference, especially when you are
                    away from home, crossing unfamiliar areas, or traveling with multiple passengers
                    who all need internet access.
                </p>

                <h2 class="pt-4 text-2xl font-bold leading-tight text-[#061324]">
                    Internet Access for All Your Devices
                </h2>

                <p>
                    A Wi-Fi hotspot is especially useful when more than one person needs to stay
                    online. Passengers can check messages, browse the web, stream music, use maps,
                    answer emails, or keep children entertained during longer drives.
                </p>

                <p>
                    Instead of using separate mobile data plans or worrying about roaming charges,
                    your group can share one convenient internet connection inside the vehicle. This
                    makes travel smoother for families, friends, colleagues, and business teams.
                </p>

                <h2 class="pt-4 text-2xl font-bold leading-tight text-[#061324]">
                    Perfect for Business and Leisure Travel
                </h2>

                <p>
                    For business travelers, staying online can be part of the job. A Wi-Fi hotspot
                    helps you check emails, join calls when parked, access documents, coordinate
                    meetings, and stay updated between destinations. It turns travel time into more
                    flexible time.
                </p>

                <p>
                    For holiday travelers, it adds comfort and freedom. You can search for
                    restaurants, check opening hours, find attractions, share photos, and stay in
                    touch with family or friends. It is especially useful when visiting a new place
                    and you need quick access to information throughout the day.
                </p>

                <p>
                    Families can also benefit from having internet in the car. Children can watch
                    videos, play online games, or use their favorite apps during longer routes,
                    making the trip more relaxed for everyone.
                </p>

                <h2 class="pt-4 text-2xl font-bold leading-tight text-[#061324]">
                    Travel With More Freedom
                </h2>

                <p>
                    Public Wi-Fi is not always available, and mobile coverage or roaming conditions
                    can vary depending on where you travel. A dedicated Wi-Fi hotspot gives you a
                    more practical way to stay connected during your rental period.
                </p>

                <p>
                    It is useful for city driving, airport transfers, road trips, countryside
                    routes, and longer journeys between destinations. Whether you need directions,
                    entertainment, or communication, internet access helps keep the trip organized
                    and enjoyable.
                </p>

                <blockquote
                    class="my-8 border-l-4 border-[#fcb102] bg-slate-50 px-6 py-5 text-lg font-medium leading-8 text-[#061324]"
                >
                    A Wi-Fi hotspot keeps your journey connected, so every passenger can stay
                    informed, entertained, and in control.
                </blockquote>

                <h2 class="pt-4 text-2xl font-bold leading-tight text-[#061324]">
                    Add Wi-Fi to Your Rental
                </h2>

                <p>
                    Adding a Wi-Fi hotspot to your car rental is a smart choice for anyone who wants
                    a smoother and more connected travel experience. It gives you internet access
                    for your devices and helps make the road feel more comfortable, productive, and
                    enjoyable.
                </p>

                <p>
                    Whether you are traveling alone, with family, with friends, or with colleagues,
                    this service helps you stay connected from the first mile to the final
                    destination.
                </p>

                <p>
                    Add a Wi-Fi hotspot to your booking and enjoy high-speed internet wherever your
                    journey takes you.
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
