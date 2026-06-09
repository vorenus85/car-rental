<template>
    <RouterLink v-if="routeName" :to="{ name: routeName }">
        <UiIcon :icon="icon" class="sidebar-menuitem-icon" />
        {{ title }}</RouterLink
    >
    <template v-else>
        <div class="sidebar-menuitem-has-child cursor-pointer" :class="{ active }" @click="toggle">
            <UiIcon :icon="icon" class="sidebar-menuitem-icon" />
            {{ title }}
            <i class="pi pi-fw pi-angle-down layout-submenu-toggler ml-auto"></i>
        </div>
    </template>
</template>
<script setup>
import UiIcon from '@admin/components/UiIcon.vue'

const emit = defineEmits(['toggle'])

defineProps({
    icon: { type: String, required: true },
    routeName: { type: String, required: false, default: '' },
    title: { type: String, required: true },
    active: { type: Boolean, default: false },
})

const toggle = () => {
    emit('toggle')
}
</script>
<style scoped>
.sidebar-menuitem-has-child .layout-submenu-toggler:before {
    transition: all 0.2s;
    display: inline-block;
}

.sidebar-menuitem-has-child.active .layout-submenu-toggler:before {
    transform: rotate(180deg);
}
</style>
