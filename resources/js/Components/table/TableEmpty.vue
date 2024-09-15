<script setup lang="ts">
import Typography from '@/Components/Elements/Typography.vue';
import type { ConcreteComponent } from 'vue';
import FormButton from '@/Components/Fields/FormButton.vue';

export type Props = {
    button?: {
        label: string;
        icon?: ConcreteComponent;
    };
    content?: string;
    title?: string;
};

withDefaults(defineProps<Props>(), {
    title: 'No Results',
    content: 'Could not find any matching results. Please try again',
});
defineEmits<{ (e: 'onclick'): void }>();
</script>

<template>
    <section
        class="border-lm-stroke bg-lm-secondary dark:border-dm-stroke flex w-full flex-col items-center rounded-lg border py-20 dark:bg-dm-secondary"
    >
        <div class="w-72 space-y-4 text-center">
            <Typography variant="h2">{{ title }}</Typography>
            <Typography variant="body1">
                <span class="text-gray-500 dark:text-gray-400">{{ content }}</span>
            </Typography>

            <FormButton v-if="button?.label" :icon="button?.icon" @click="$emit('onclick')">
                {{ button.label }}
            </FormButton>
        </div>
    </section>
</template>
