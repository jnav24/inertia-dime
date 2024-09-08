<script setup lang="ts">
import { computed } from 'vue';
import CheckCircle from "@/Components/Icons/outline/CheckCircle.vue";
import CloseCircle from "@/Components/Icons/outline/CloseCircle.vue";
import ExclamationCircle from "@/Components/Icons/outline/ExclamationCircle.vue";
import InformationCircle from "@/Components/Icons/outline/InformationCircle.vue";

type Props = { message: string; title: string | null; type: 'error' | 'success' | 'warn' | 'info' };
const props = withDefaults(defineProps<Props>(), { title: null });

const classes = computed(() => {
    switch (props.type) {
        case "error":
            return 'border-red-600 bg-red-200 text-red-700 dark:bg-red-600 dark:text-white';
        case "info":
            return 'border-blue=600 bg-blue-200'
        case "success":
            return 'border-green-400 bg-green-300 text-green-800 dark:bg-green-600 dark:text-white';
        default:
            return 'border-yellow-500 bg-yellow-200';
    }
});
</script>

<template>
    <div
        class="mb-4 flex items-start justify-start rounded-xl border px-4 py-3"
        :class="classes"
        role="alert"
    >
        <div :class="classes">
            <CloseCircle classes="size-8" v-if="type === 'error'" />
            <CheckCircle classes="size-8" v-if="type === 'success'" />
            <ExclamationCircle classes="size-8" v-if="type === 'warn'" />
            <InformationCircle classes="size-8" v-if="type === 'info'" />
        </div>
        <div class="ml-2 flex flex-col">
            <span v-if="title" class="font-bold">{{ title }}</span>
            <span>{{ message }}</span>
        </div>
    </div>
</template>
