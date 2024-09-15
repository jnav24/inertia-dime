<script setup lang="ts">
import Typography from '@/Components/Elements/Typography.vue';
import FormButton from '@/Components/Fields/FormButton.vue';
import FormSelect from '@/Components/Fields/FormSelect.vue';
import ChevronDoubleLeft from '@/Components/Icons/outline/ChevronDoubleLeft.vue';
import ChevronDoubleRight from '@/Components/Icons/outline/ChevronDoubleRight.vue';
import { computed, toRefs } from 'vue';

type Emits = { (e: 'page-change', v: number): void; (e: 'selection', v: number): void };

type Props = {
    options: number[];
    page: number;
    selected: number;
    total: number;
};

defineEmits<Emits>();
const props = defineProps<Props>();
const { options, page, selected, total } = toRefs(props);

const allowedLinks = 5;

const items = computed(() => options.value.map((op) => ({ label: op.toString(), value: op })));
const pages = computed(() => Math.ceil(total.value / selected.value));
const endNumber = computed(() => {
    const value = selected.value * page.value;
    return total.value < value ? total.value : value;
});
const startNumber = computed(() => 1 + selected.value * (page.value - 1));
</script>

<template>
    <div class="flex flex-row items-center justify-between px-4 py-4">
        <div>
            <Typography variant="caption">
                Showing {{ startNumber }}-{{ endNumber }} of {{ total }} results
            </Typography>
        </div>

        <div class="flex flex-row items-center space-x-2">
            <FormSelect
                @handle-selection="$emit('selection', +$event)"
                hide-label
                :items="items"
                label=""
                :value="selected"
            />
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
