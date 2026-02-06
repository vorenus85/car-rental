<template>
    <li class="sidebar-menuitem">
        <RouterLink :to="{ name: routeName }">
            <UiIcon :icon="icon" class="sidebar-menuitem-icon" />
            {{ title }}</RouterLink
        >
    </li>
</template>
<script setup>
import UiIcon from '@/components/UiIcon.vue'

defineProps({
    icon: { type: String, required: true },
    routeName: { type: String, required: true },
    title: { type: String, required: true },
})
</script>
