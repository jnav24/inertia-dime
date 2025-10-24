<script setup lang="ts">
import CheckCircle from '@/Components/Icons/solid/CheckCircle.vue';

defineProps<{ obj: { data: { confirmation?: string } } }>();
</script>

<template>
    <CheckCircle v-if="obj.data?.confirmation" classes="size-8 text-primary" />
</template>
