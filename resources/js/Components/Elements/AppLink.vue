<script setup lang="ts">
import { Link, InertiaLinkProps } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps<InertiaLinkProps>();

const styles = computed(() => {
    if (props.as === 'button') {
        const base =
            'focus:shadow-outline rounded-md transition duration-150 focus:outline-none px-6 py-3 text-sm';
        return `${base} border border-gray-300 bg-white text-gray-700 hover:bg-gray-100 active:bg-gray-200`;
    }

    return 'text-primary hover:text-dm-primary';
});
</script>

<template>
    <Link :class="styles" v-bind="props"><slot /></Link>
</template>
