<script setup>
import ServicesListCard from './ServicesListCard.vue'

const services = [
    {
        title: 'Airport Transfers',
        description:
            'Hassle-free pickup and drop-off at the airport. Our driver will be waiting for you.',
        icon: 'pi pi-car',
        img: 'airport-transfers',
    },
    {
        title: 'One Way Rentals',
        description: 'Pick up in one location and drop off in another. Travel your way.',
        icon: 'pi pi-arrow-right-arrow-left',
        img: 'one-way-rentals',
    },
    {
        title: 'Additional Drivers',
        description: 'Add another driver to share the driving and enjoy a more relaxed trip.',
        icon: 'pi pi-user',
        img: 'additional-drivers',
    },
    {
        title: 'Roadside Assistance',
        description: '24/7 support in case of breakdown, tire issues or any unexpected situation.',
        icon: 'pi pi-wrench',
        img: 'roadside-assistance',
    },
    {
        title: 'Child Seats',
        description: 'Safe and comfortable seats for children up to 12 years old.',
        icon: 'pi pi-shield',
        img: 'child-seats',
    },
    {
        title: 'GPS Navigation',
        description: 'Stay on track with up-to-date maps and reliable voice guidance.',
        icon: 'pi pi-map',
        img: 'gps-navigation',
    },
    {
        title: 'Wi-Fi Hotspot',
        description: 'Stay connected on the go with high-speed internet for all your devices.',
        icon: 'pi pi-wifi',
        img: 'wifi-hotspot',
    },
    {
        title: 'Pet Travel Kit',
        description: 'Everything you need for a safe and comfortable trip with your pet.',
        icon: 'pi pi-star',
        img: 'pet-travel-kit',
    },
    {
        title: 'Professional Chauffeur',
        description: 'Sit back and relax with our professional chauffeur service for any occasion.',
        icon: 'pi pi-user',
        img: 'professional-chauffeur',
    },
    {
        title: 'Corporate Solutions',
        description:
            'Tailored rental solutions for businesses with flexible terms and great benefits.',
        icon: 'pi pi-briefcase',
        img: 'corporate-solutions',
    },
    {
        title: 'Long-Term Rentals',
        description:
            'Special rates for long-term rentals. Perfect for extended stays or business needs.',
        icon: 'pi pi-calendar',
        img: 'long-term-rentals',
    },
    {
        title: 'Luxury & Premium Fleet',
        description:
            'Experience comfort and style with our selection of luxury and premium vehicles.',
        icon: 'pi pi-star-fill',
        img: 'luxury-premium-fleet',
    },
]
</script>

<template>
    <section class="py-12">
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-4">
            <ServicesListCard
                v-for="service in services"
                :key="service.title"
                :services="[service]"
            />
        </div>
    </section>
</template>
