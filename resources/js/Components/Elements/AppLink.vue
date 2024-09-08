<script setup lang="ts">
import { Link, InertiaLinkProps } from '@inertiajs/vue3';

const props = defineProps<InertiaLinkProps>();
</script>

<template>
    <Link class="text-primary hover:text-dm-primary" v-bind="props"><slot /></Link>
</template>
