<script setup lang="ts">
import FooterSection from '../components/sections/FooterSection.vue'
import HeaderSection from '../components/sections/HeaderSection.vue'
</script>

<template>
    <div class="min-h-screen bg-gray-50">
        <HeaderSection></HeaderSection>

        <main id="main">
            <slot />
        </main>

        <FooterSection></FooterSection>
    </div>
</template>
