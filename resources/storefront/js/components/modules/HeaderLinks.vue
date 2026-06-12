<template>
    <nav class="header-links hidden lg:flex">
        <RouterLink v-for="menu in headerMenu" :key="menu.id" :to="{ name: menu.name }">{{
            menu.title
        }}</RouterLink>
    </nav>
</template>
<script setup>
import { useHeaderMenu } from '@storefront/composables/useHeaderMenu'

const { headerMenu } = useHeaderMenu()
</script>
<style scoped lang="scss">
.header-links {
    a {
        opacity: 0.75;
        font-weight: 400;
        color: #fff;
        position: relative;

        &:after {
            content: '';
            display: block;
            position: absolute;
            bottom: -5px;
            left: 0;
            height: 2px;
            width: 0;
            background: var(--primary-color);
            transition:
                width 0.2s,
                opacity 0.2s;
        }

        &.router-link-active,
        &:hover {
            opacity: 1;
            &:after {
                width: 100%;
            }
        }
    }

    a.router-link-exact-active {
        opacity: 1;
    }
}

@media (min-width: 992px) {
    .header-links {
        gap: 20px;
    }
}

@media (min-width: 1200px) {
    .header-links {
        gap: 45px;
    }
}
</style>
