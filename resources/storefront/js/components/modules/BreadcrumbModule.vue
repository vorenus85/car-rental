<template>
    <div class="card flex justify-start">
        <Breadcrumb :home="home" :model="items">
            <template #item="{ item, props }">
                <router-link v-if="item.route" v-slot="{ href, navigate }" :to="item.route" custom>
                    <a :href="href" v-bind="props.action" @click="navigate">
                        {{ item.label }}
                    </a>
                </router-link>

                <a v-else-if="item.url" :href="item.url" v-bind="props.action">
                    {{ item.label }}
                </a>

                <span v-else>
                    {{ item.label }}
                </span>
            </template>
        </Breadcrumb>
    </div>
</template>

<script setup>
import { Breadcrumb } from 'primevue'
import { ref } from 'vue'

defineProps({
    items: {
        type: Array,
        default: () => {
            return []
        },
    },
})

const home = ref({
    label: 'Home',
    icon: 'pi pi-home',
    route: '/',
})
</script>
<style>
.p-breadcrumb {
    --p-breadcrumb-background: transparent;
    --p-breadcrumb-padding: 1rem 0;
}
</style>
