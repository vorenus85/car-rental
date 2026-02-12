<template>
    <RouterLink v-if="routeName" :to="{ name: routeName }">
        <UiIcon :icon="icon" class="sidebar-menuitem-icon" />
        {{ title }}</RouterLink
    >
    <template v-else>
        <div class="sidebar-menuitem-has-child cursor-pointer" @click="toggle">
            <UiIcon :icon="icon" class="sidebar-menuitem-icon" />
            {{ title }}
            <i class="pi pi-fw pi-angle-down layout-submenu-toggler ml-auto"></i>
        </div>
    </template>
</template>
<script setup>
import UiIcon from '@/components/UiIcon.vue'

const emit = defineEmits(['toggle'])

defineProps({
    icon: { type: String, required: true },
    routeName: { type: String, required: false, default: '' },
    title: { type: String, required: true },
})

const toggle = () => {
    emit('toggle')
}
</script>
