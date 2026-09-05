<script setup lang="ts">
import FormInput from '@/Components/Fields/FormInput.vue';
import ExpenseFormActions from '@/Components/Forms/ExpenseFormActions.vue';
import FormSelect from '@/Components/Fields/FormSelect.vue';
import ExpenseFormConfirmation from '@/Components/Forms/ExpenseFormConfirmation.vue';
import { ExpenseFormEmits, UserVehicle, UserVehicleExpenseFormProps } from '@/types/expenses';
import { computed, onMounted, ref } from 'vue';
import { convertToDollar } from '@/utils/functions';
import { dueDates } from '@/utils/helpers';
import { usePage } from '@inertiajs/vue3';
import PayoffEstimator from '@/Components/PayoffEstimator.vue';

defineEmits<ExpenseFormEmits>();
const props = defineProps<UserVehicleExpenseFormProps>();

const page = usePage();

const payoffAmount = ref(props.expense?.data.amount ?? 0.0);
const payoffApr = ref(props.expense?.data.apr ?? 0.0);
const payoffBalance = ref(props.expense?.data.balance ?? 0.0);
const payoffLimit = ref(props.expense?.data.limit ?? 0.0);
const typeSelected = ref('');

const amount = computed(() => convertToDollar(props.expense?.data.amount));
const balance = computed(() => convertToDollar(props.expense?.data.balance));
const limit = computed(() => convertToDollar(props.expense?.data.limit));
const isMileage = computed(() => {
    return props.types.find((item) => item.id === typeSelected.value)?.slug === 'gas';
});
const userVehicles = computed(() => {
    const vehiclesData = page.props.vehicles as { data: UserVehicle[] };
    return vehiclesData.data.map((vehicle) => ({
        value: vehicle.id,
        label: `${vehicle.year} ${vehicle.make} ${vehicle.model}`,
    }));
});
const canShowPayoffPanel = computed(() => {
    const allowed = ['finance', 'lease'];
    const slug = props.types.find((item) => item.id === typeSelected.value)?.slug;
    return !props.isTemplate && allowed.includes(slug ?? '');
});

onMounted(() => {
    const savedExpense = props.types.find((item) => item.id === props.expense?.expense.id);
    typeSelected.value = savedExpense?.id ?? '';
});
</script>

<template>
    <PayoffEstimator
        :amount="payoffAmount"
        :apr="payoffApr"
        :balance="payoffBalance"
        :limit="payoffLimit"
        :show-payoff-panel="canShowPayoffPanel"
        :show-payoff-summary="false"
    >
        <div class="mb-6 grid grid-cols-2 gap-4">
            <FormInput label="Template" hidden :value="String(!!isTemplate)" />
            <FormSelect
                :items="userVehicles"
                label="Vehicle"
                :value="expense?.vehicle.id ?? ''"
                :rules="['required']"
            />
            <FormInput
                @update:value="payoffAmount = Number($event)"
                :rules="['required', 'float:2']"
                :value="amount"
                label="Amount"
            />
            <FormSelect
                :items="types"
                label="Account Type"
                item-label="name"
                item-value="id"
                :value="expense?.expense.id ?? ''"
                :rules="['required']"
                @handle-selection="typeSelected = $event"
            />
            <FormInput
                @update:value="payoffBalance = Number($event)"
                label="Balance"
                :rules="['required', 'min:3']"
                :value="balance"
            />
            <FormInput
                label="Mileage"
                v-if="isMileage"
                :rules="['required', 'min:3']"
                :value="(expense?.data?.mileage ?? '').toString()"
            />
            <FormSelect
                v-if="isTemplate"
                :items="dueDates"
                label="Due Date"
                :value="(expense?.data?.due_date ?? 1).toString()"
            />
        </div>

        <div class="mt-4 grid grid-cols-2 gap-4">
            <FormInput @update:value="payoffLimit = Number($event)" label="Limit" :value="limit" />
            <FormInput
                @update:value="payoffApr = Number($event)"
                label="APR"
                :value="(expense?.data?.apr ?? 0.0).toString()"
            />
        </div>

        <ExpenseFormConfirmation v-if="!isTemplate" :expense="expense" />
        <ExpenseFormActions @close="$emit('close')" />
    </PayoffEstimator>
</template>
