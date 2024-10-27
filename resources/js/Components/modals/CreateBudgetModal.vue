<script setup lang="ts">
import Modal from '@/Components/modals/Modal.vue';
import Typography from '@/Components/Elements/Typography.vue';
import FormButton from '@/Components/Fields/FormButton.vue';
import BudgetForm from '@/Components/Fields/BudgetForm.vue';
import FormSelect from '@/Components/Fields/FormSelect.vue';
import { BudgetAggregation } from '@/types/budget';
import { onMounted, ref } from 'vue';
import { getAllMonths } from '@/utils/timestamp';

type Emits = {
    (e: 'update:show', v: boolean): void;
};

type Props = {
    aggregations: BudgetAggregation;
    show: boolean;
};

defineEmits<Emits>();
const props = defineProps<Props>();

const defaultMonth = ref('');
const defaultYear = ref('');
const months = ref<{ label: string; value: string }[]>([]);
const years = ref<{ label: string; value: string }[]>([]);

const setDefaultValues = () => {
    const d = new Date();
    const year = d.getFullYear().toString();
    const nextYear = (Number(year) + 1).toString();
    let allYears = Object.keys(props.aggregations ?? {});

    for (let month = d.getMonth() + 1; month <= 12; month++) {
        if (!props.aggregations[year]?.[month.toString()]) {
            if (
                month === 12 &&
                props.aggregations[year.toString()]?.['12'] &&
                !props.aggregations[nextYear]
            ) {
                defaultMonth.value = '01';
                defaultYear.value = nextYear;
                allYears = [nextYear, ...allYears];
                break;
            }

            if (!allYears.includes(year)) {
                allYears = [year, ...allYears].sort().reverse();
            }

            defaultMonth.value = month.toString().padStart(2, '0');
            defaultYear.value = year;
            break;
        }
    }

    months.value = getAllMonths('full');
    years.value = allYears.map((yr) => ({ label: yr, value: yr }));
};

onMounted(() => {
    setDefaultValues();
});
</script>

<template>
    <Modal :show="show" @close-modal="$emit('update:show', false)" hide-close-button>
        <BudgetForm :action="route('budget.store')">
            <div class="w-100">
                <div class="mb-4 space-y-4 p-4">
                    <Typography variant="h2">Create Budget</Typography>

                    <div class="mb-4 grid grid-cols-2 gap-3">
                        <FormSelect :items="months" label="Month" :value="defaultMonth" />
                        <FormSelect :items="years" label="Year" :value="defaultYear" />
                    </div>
                </div>

                <div
                    class="flex flex-row items-end justify-end space-x-2 rounded-b-lg border-t-2 border-lm-stroke p-4"
                >
                    <FormButton @click="$emit('update:show', false)">Cancel</FormButton>
                    <FormButton color="primary" @click="$emit('update:show', false)">
                        New Budget
                    </FormButton>
                </div>
            </div>
        </BudgetForm>
    </Modal>
</template>
