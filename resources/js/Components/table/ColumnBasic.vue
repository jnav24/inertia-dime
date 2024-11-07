<script setup lang="ts">
import Typography from '@/Components/Elements/Typography.vue';
import { ColumnBasicProps } from '@/types/table';

defineProps<ColumnBasicProps>();
</script>

<template>
    <Typography variant="body2">{{ value }}</Typography>
</template>
