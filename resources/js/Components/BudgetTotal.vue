<script setup lang="ts">
import { type ConcreteComponent, resolveComponent } from 'vue';

type Props = {
    amount: string;
    icon?: ConcreteComponent | string;
    title: string;
};

const props = defineProps<Props>();

const setIcon = () => {
    if (typeof props.icon === 'string') {
        return resolveComponent(props.icon);
    }

    return props.icon;
};
</script>

<template>
    <div class="flex flex-row items-center">
        <div class="mr-2 rounded-full bg-primary p-2">
            <component :is="setIcon()" class="size-6 text-white" />
        </div>

        <div class="space-y-0">
            <p class="text-sm text-gray-500">{{ title }}</p>
            <p class="font-body text-xl text-gray-700">{{ amount }}</p>
        </div>
    </div>
</template>
