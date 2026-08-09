<script setup lang="ts">
import { ref, watchEffect } from 'vue';

type SelectItems = Record<string, string>;

type Emits = {
    (e: 'handle-selection', v: string): void;
};

type Props = {
    show: boolean;
    itemLabel?: string;
    items: SelectItems[];
    itemValue?: string;
};

const emit = defineEmits<Emits>();
const props = withDefaults(defineProps<Props>(), {
    itemLabel: 'label',
    itemValue: 'value',
});

const dropDownItems = ref<HTMLDivElement | null>(null);

watchEffect(() => {
    if (!props.show) {
        setTimeout(() => dropDownItems.value?.classList.add('h-0', 'py-0'), 300);
    } else {
        dropDownItems.value?.classList.remove('h-0', 'py-0');
    }
});

const handleSelection = (value: string) => {
    emit('handle-selection', value);
    // if (props.show) {}
};
</script>

<template>
    <div
        class="dark:bg-dark-main absolute left-0 top-0 max-h-48 w-full transform overflow-y-auto rounded border border-gray-300 bg-white shadow-sm transition duration-300 ease-out"
        :class="{
            'translate-y-12 opacity-100': show,
            'translate-y-0 opacity-0': !show,
        }"
        ref="dropDownItems"
    >
        <div
            class="p-2 text-sm hover:bg-gray-200"
            v-for="(item, index) in items"
            :key="index"
            @click="handleSelection(item[itemValue])"
        >
            <slot v-if="$slots.default" :item="item" />
            <span v-else>{{ item[itemLabel] }}</span>
        </div>
    </div>
</template>
