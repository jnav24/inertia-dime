<script setup lang="ts">
import { computed, provide, reactive, ref } from 'vue';
import Typography from '@/Components/Elements/Typography.vue';
import { TabContext, TabContextType } from '@/types/tabs';

const tabs = reactive<Record<string, HTMLButtonElement | null>>({});
const selectedTab = ref('');

const activeTab = computed(() => selectedTab.value);
const tabKeys = computed(() => Object.keys(tabs));
const tabIndicatorStyles = computed(() => {
    const rect = tabs[activeTab.value]?.getBoundingClientRect();
    let leftPosition = 0;

    if (tabKeys.value.length) {
        leftPosition = rect?.left - tabs[tabKeys.value[0]]?.getBoundingClientRect()?.left;
    }

    return { left: `${leftPosition}px`, width: `${rect?.width ?? 0}px` };
});

const addTab = (tab: string) => {
    if (!tabs[tab]) {
        if (!tabKeys.value.length) {
            selectedTab.value = tab;
        }

        tabs[tab] = null;
    }
};

provide<TabContextType>(TabContext, {
    activeTab,
    addTab,
});
</script>

<template>
    <section>
        <div class="relative">
            <div class="flex space-x-4 pb-6">
                <button
                    v-for="(tab, idx) in tabKeys"
                    :key="idx"
                    @click="selectedTab = tab"
                    :ref="(el) => (tabs[tab] = el)"
                    type="button"
                >
                    <Typography variant="body2">
                        <span
                            :class="{
                                'transition-all duration-300 ease-in-out hover:text-primary':
                                    selectedTab !== tab,
                            }"
                        >
                            {{ tab }}
                        </span>
                    </Typography>
                </button>
            </div>

            <div
                class="absolute bottom-0 h-1 rounded bg-dm-primary transition-all duration-200 ease-in-out"
                :style="tabIndicatorStyles"
            ></div>
        </div>

        <div class="mt-6">
            <slot />
        </div>
    </section>
</template>
