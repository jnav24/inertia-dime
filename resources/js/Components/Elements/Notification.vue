<script setup lang="ts">
import Typography from '@/Components/Elements/Typography.vue';
import CheckCircle from '@/Components/Icons/outline/CheckCircle.vue';
import type { NotificationProps } from '@/types/providers';

defineProps<NotificationProps>();
</script>

<template>
    <section class="flex w-96 items-start space-x-2 rounded-lg bg-dm-stroke px-2 py-5">
        <div>
            <CheckCircle v-if="type === 'success'" classes="size-6 text-primary" />
        </div>
        <div>
            <Typography variant="body1">
                <span class="text-white">{{ title }}</span>
            </Typography>
            <Typography variant="caption">
                <span class="text-gray-400">{{ message }}</span>
            </Typography>
        </div>
    </section>
</template>
