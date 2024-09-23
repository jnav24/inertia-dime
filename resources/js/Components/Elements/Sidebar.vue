<script setup lang="ts">
import Typography from '@/Components/Elements/Typography.vue';
import { onMounted, ref } from 'vue';
import { toTitleCase } from '@/utils/functions';

type Emits = {
    (e: 'on-selection', v: string): void;
};

type Props = {
    items: string[];
    value?: string;
};

const emit = defineEmits<Emits>();
const props = defineProps<Props>();

const selected = ref('');

onMounted(() => {
    selected.value = props.value ?? props.items?.[0] ?? '';
});

const handleSelection = (v: string) => {
    selected.value = v;
    emit('on-selection', v);
};
</script>

<template>
    <div class="space-y-8">
        <Typography tag="p" variant="h3">Expenses</Typography>
        <ul>
            <li
                v-for="(item, idx) in items"
                :key="idx"
                class="flex flex-row items-center justify-between rounded"
                :class="{
                    'cursor-pointer px-2 py-2 text-sm text-gray-500 hover:bg-gray-200 hover:text-gray-700':
                        selected !== item,
                    'cursor-pointer bg-gray-300 px-2 py-2 text-sm text-gray-700': selected === item,
                }"
                @click="handleSelection(item)"
            >
                {{ toTitleCase(item) }}
            </li>
        </ul>
    </div>
</template>
