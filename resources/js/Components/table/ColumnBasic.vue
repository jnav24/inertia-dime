<script setup lang="ts">
import Typography from '@/Components/Elements/Typography.vue';

defineProps<{ value: string }>();
</script>

<template>
    <Typography variant="body2">{{ value }}</Typography>
</template>
