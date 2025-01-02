<script setup lang="ts">
import CheckCircle from '@/Components/Icons/solid/CheckCircle.vue';
import { ValueOfExpense } from '@/types/expenses';

defineProps<{ obj: ValueOfExpense }>();
</script>

<template>
    <CheckCircle v-if="obj.data?.confirmation" classes="size-8 text-primary" />
</template>
