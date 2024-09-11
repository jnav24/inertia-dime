<script setup lang="ts">
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps<{
    href: string;
    active?: boolean;
}>();

const classes = computed(() =>
    props.active
        ? 'bg-primary/25 text-white dark:text-gray-100 focus:outline-none focus:border-indigo-700'
        : 'border-2 border-transparent text-white hover:text-white hover:border-primary/25 focus:outline-none focus:text-white dark:focus:text-white focus:border-gray-300',
);
</script>

<template>
    <Link
        :href="href"
        class="inline-flex items-center rounded-lg px-4 py-2 text-sm font-medium leading-5 transition duration-150 ease-in-out"
        :class="classes"
    >
        <slot />
    </Link>
</template>
