<template>
    <PublicLayout>
        <section class="relative overflow-hidden">
            <ServicesArticleHero
                title="One Way Rentals"
                intro="Pick up your rental car in one location and return it in another. Travel your way, without unnecessary detours or fixed round-trip plans."
                image="/images/services/large/one-way-rentals.webp"
            ></ServicesArticleHero>
        </section>
        <article class="container mx-auto px-6 py-12 text-slate-700">
            <div class="space-y-6 text-base leading-8">
                <p>
                    Not every journey is a round trip. Sometimes your plans take you from one city
                    to another, from the airport to a different destination, or across a region
                    where returning to the original pickup point would only waste time. With our one
                    way rental service, your car rental can follow your real travel plans instead of
                    forcing you into a fixed route.
                </p>

                <p>
                    One way rentals give you the freedom to pick up your vehicle in one location and
                    drop it off somewhere else. It is a practical and flexible solution for
                    travelers who want to make the most of their time, whether they are planning a
                    business trip, a holiday route, a relocation, or a longer journey with multiple
                    stops.
                </p>

                <p>
                    Instead of driving back only to return the car, you can continue forward. This
                    makes your trip smoother, more efficient, and often much more enjoyable. You
                    choose where the journey starts, where it ends, and how you want to travel
                    between the two.
                </p>

                <h2 class="pt-4 text-2xl font-bold leading-tight text-[#061324]">
                    More Freedom for Flexible Travel Plans
                </h2>

                <p>
                    A one way rental is ideal when your schedule does not fit the traditional car
                    rental model. Maybe you are landing at one airport and leaving from another.
                    Maybe you are visiting several cities and do not want to repeat the same route.
                    Or maybe your trip simply has a different start and end point.
                </p>

                <p>
                    With this service, you can build your travel plan around your needs. You are not
                    limited by the pickup location, and you do not have to change your itinerary
                    just to return the car. This gives you more control over your time and a better
                    overall travel experience.
                </p>

                <h2 class="pt-4 text-2xl font-bold leading-tight text-[#061324]">
                    Save Time and Avoid Unnecessary Driving
                </h2>

                <p>
                    One of the biggest advantages of one way rentals is convenience. Driving back to
                    the original location can add hours to your journey, increase fuel costs, and
                    make the trip more tiring than it needs to be. A one way rental helps you avoid
                    that extra distance.
                </p>

                <p>
                    This is especially useful for road trips, business travel, airport transfers,
                    and customers who need a vehicle for a specific route. You can arrive at your
                    final destination, return the car there, and continue with your plans without
                    losing valuable time.
                </p>

                <p>
                    For business travelers, this can mean a more efficient schedule and less time
                    spent on the road. For holiday travelers, it means more time enjoying the
                    destination and less time repeating the same drive. For families or groups, it
                    can make the whole journey simpler and more comfortable.
                </p>

                <h2 class="pt-4 text-2xl font-bold leading-tight text-[#061324]">
                    Perfect for Road Trips and Multi-City Journeys
                </h2>

                <p>
                    If you are planning a road trip, a one way rental can open up many more
                    possibilities. You can start your journey in one city, explore scenic routes,
                    visit different places along the way, and finish your trip in another location.
                    There is no need to turn back unless you want to.
                </p>

                <p>
                    This type of rental is also useful for customers who are moving between cities,
                    attending events, traveling for work, or combining several destinations into one
                    trip. The car becomes part of your route, not an obstacle you need to return to
                    its starting point.
                </p>

                <blockquote
                    class="my-8 border-l-4 border-[#fcb102] bg-slate-50 px-6 py-5 text-lg font-medium leading-8 text-[#061324]"
                >
                    One way rentals are designed for real journeys: flexible, practical, and built
                    around where you actually need to go.
                </blockquote>

                <h2 class="pt-4 text-2xl font-bold leading-tight text-[#061324]">
                    Travel Your Way
                </h2>

                <p>
                    Our one way rental service is created to make car rental easier and more
                    natural. You choose the pickup location, select your vehicle, and return it at
                    another approved location when your journey is complete. The process is simple,
                    clear, and convenient from start to finish.
                </p>

                <p>
                    Whether you are traveling for business, planning a holiday, organizing a
                    long-distance route, or simply need more flexibility, one way rentals help you
                    move with confidence. You can focus on the road ahead instead of worrying about
                    how to get back.
                </p>

                <p>
                    Pick up in one location, drop off in another, and enjoy the freedom to travel
                    your way.
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
