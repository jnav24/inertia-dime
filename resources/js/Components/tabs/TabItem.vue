<script setup lang="ts">
import { inject, onMounted, watchEffect } from 'vue';
import { TabContext, TabContextType } from '@/types/tabs';

type Props = {
    title: string;
};

const props = defineProps<Props>();

const { activeTab, addTab } = inject<TabContextType>(TabContext, {} as TabContextType);

onMounted(() => {
    addTab(props.title);
});
</script>

<template>
    <div v-if="activeTab === title">
        <slot />
    </div>
</template>
