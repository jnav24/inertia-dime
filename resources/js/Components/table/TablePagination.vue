<script setup lang="ts">
import Typography from '@/Components/Elements/Typography.vue';
import FormButton from '@/Components/Fields/FormButton.vue';
import FormSelect from '@/Components/Fields/FormSelect.vue';
import ChevronDoubleLeft from '@/Components/Icons/outline/ChevronDoubleLeft.vue';
import ChevronDoubleRight from '@/Components/Icons/outline/ChevronDoubleRight.vue';
import { toRefs } from 'vue';

type Props = {
    options: number[];
    page: number;
    selected: number;
    total: number;
};

defineEmits<{ (e: 'page-change', v: number): void; (e: 'selection', v: number): void }>();
const props = defineProps<Props>();
const { options, page, selected, total } = toRefs(props);

const allowedLinks = 5;

const items = computed(() => options.map((op) => ({ label: op.toString(), value: op.toString() })));
const pages = computed(() => Math.ceil(total / selected));
const endNumber = computed(() => {
    const value = selected * page;
    return total < value ? total : value;
});
const startNumber = computed(() => 1 + selected * (page - 1));
</script>

<template>
    <div class="flex flex-row items-center justify-between px-4 py-4">
        <div>
            <Typography variant="caption">
                Showing {{ startNumber }}-{{ endNumber }} of {{ total }} results
            </Typography>
        </div>

        <div class="flex flex-row items-center space-x-2">
            <FormSelect handle-selection="" items="" label="" v-model:value="" />
            <Typography variant="caption">per page</Typography>
        </div>

        <div class="flex flex-row items-center space-x-2">
            <template v-if="pages > 1">
                <FormButton fab :disabled="page === 1" @click="$emit('page-change', 1)">
                    <ChevronDoubleLeft classes="size-4" />
                </FormButton>
                <template v-if="pages < allowedLinks">
                    <FormButton
                        v-for="num in pages"
                        :color="page === num + 1 ? 'default' : 'secondary'"
                        :key="num"
                        @click="$emit('page-change', pages)"
                    >
                        {{ num + 1 }}
                    </FormButton>
                </template>
                <FormButton fab :disabled="page === pages" @click="$emit('page-change', pages)">
                    <ChevronDoubleRight classes="size-4" />
                </FormButton>
            </template>
        </div>
    </div>
</template>
