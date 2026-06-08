<template>
    <i :class="`pi pi-fw pi-${icon}`"></i>
</template>
<script setup>
defineProps({
    icon: {
        type: String,
        required: true,
    },
})
</script>
