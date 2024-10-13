<script setup lang="ts">
import { computed, provide, ref } from 'vue';
import Typography from '@/Components/Elements/Typography.vue';
import { TabContext, TabContextType } from '@/types/tabs';

const tabs = ref([]);
const selectedTab = ref('');

const activeTab = computed(() => selectedTab.value);

const addTab = (tab: string) => {
    if (!tabs.value.includes(tab)) {
        if (!tabs.value.length) {
            selectedTab.value = tab;
        }

        tabs.value = [...tabs.value, tab];
    }
};

provide<TabContextType>(TabContext, {
    activeTab,
    addTab,
});
</script>

<template>
    <section>
        <div class="flex space-x-4 pb-6">
            <button v-for="(tab, idx) in tabs" :key="idx" @click="selectedTab = tab" type="button">
                <Typography variant="body2">
                    {{ tab }}
                </Typography>
            </button>
        </div>

        <div class="bg-red-300">
            <slot />
        </div>
    </section>
</template>
