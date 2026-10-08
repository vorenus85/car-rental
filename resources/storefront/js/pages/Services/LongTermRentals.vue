<template>
    <PublicLayout>
        <section class="relative overflow-hidden">
            <ServicesArticleHero
                title="Long-Term Rentals"
                intro="Get special rates for long-term rentals, perfect for extended stays, business travel, temporary projects, and flexible mobility needs."
                image="/images/services/long-term-rentals.webp"
            ></ServicesArticleHero>
        </section>
        <article class="container mx-auto px-6 py-12 text-slate-700">
            <div class="space-y-6 text-base leading-8">
                <p>
                    Not every car rental is just for a day or a weekend. Sometimes you need a
                    reliable vehicle for several weeks, a month, or even longer. Our long-term
                    rental service is designed for customers who need flexible access to a car
                    without the commitment of buying, leasing, or managing their own vehicle.
                </p>

                <p>
                    Whether you are staying in the area for an extended period, working on a
                    temporary project, waiting for your own car to become available, or managing
                    business travel needs, long-term rentals offer a practical and cost-effective
                    solution.
                </p>

                <p>
                    With special rates for extended rentals, you can enjoy the convenience of having
                    a vehicle available every day while keeping your plans flexible.
                </p>

                <h2 class="pt-4 text-2xl font-bold leading-tight text-[#061324]">
                    Ideal for Extended Stays
                </h2>

                <p>
                    Long-term rentals are especially useful when you are staying in a city or region
                    for more than a few days. Instead of depending on public transport, taxis, or
                    short rental periods, you can have a car ready whenever you need it.
                </p>

                <p>
                    This gives you more freedom in your daily schedule. You can travel to meetings,
                    visit nearby places, handle shopping, explore the area, or manage family plans
                    without arranging transport again and again.
                </p>

                <h2 class="pt-4 text-2xl font-bold leading-tight text-[#061324]">
                    A Smart Choice for Business Needs
                </h2>

                <p>
                    For companies and professionals, long-term car rental can be a practical
                    alternative to maintaining a company vehicle or arranging repeated short
                    rentals. It works well for temporary assignments, project-based work, visiting
                    employees, consultants, sales teams, and business trips that last longer than
                    expected.
                </p>

                <p>
                    A long-term rental gives your business access to reliable transport without
                    long-term ownership costs. You can keep your team mobile, support daily
                    operations, and adjust the rental period based on the real needs of the project.
                </p>

                <p>
                    It is also easier to plan costs when the vehicle is arranged for a longer
                    period. With special long-term rates, your rental can become more predictable
                    and efficient.
                </p>

                <h2 class="pt-4 text-2xl font-bold leading-tight text-[#061324]">
                    Flexible Without the Commitment
                </h2>

                <p>
                    Buying or leasing a vehicle is not always the right answer, especially when your
                    need is temporary. Long-term rentals give you the benefits of having a car
                    without the responsibilities that come with ownership.
                </p>

                <p>
                    You do not need to worry about selling the vehicle later, committing to a long
                    lease, or managing a full fleet for short-term requirements. You simply choose
                    the vehicle and rental period that fit your plans.
                </p>

                <blockquote
                    class="my-8 border-l-4 border-[#fcb102] bg-slate-50 px-6 py-5 text-lg font-medium leading-8 text-[#061324]"
                >
                    Long-term rentals give you everyday mobility with more flexibility and less
                    commitment.
                </blockquote>

                <h2 class="pt-4 text-2xl font-bold leading-tight text-[#061324]">
                    Book a Long-Term Rental
                </h2>

                <p>
                    Whether you need a car for an extended stay, business project, temporary
                    replacement, or personal mobility, our long-term rental service gives you a
                    reliable and flexible solution.
                </p>

                <p>
                    You can enjoy the comfort of having a vehicle available whenever you need it,
                    while benefiting from rental terms designed for longer use.
                </p>

                <p>
                    Choose a long-term rental and enjoy flexible, dependable mobility for as long as
                    your plans require.
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
