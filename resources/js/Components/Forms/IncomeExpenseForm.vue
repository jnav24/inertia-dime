<script setup lang="ts">
import FormInput from '@/Components/Fields/FormInput.vue';
import ExpenseFormActions from '@/Components/Forms/ExpenseFormActions.vue';
import FormSelect from '@/Components/Fields/FormSelect.vue';
import { ExpenseFormEmits, IncomeExpenseFormProps } from '@/types/expenses';
import { computed } from 'vue';
import { convertToDollar } from '@/utils/functions';
import FormDatePicker from '@/Components/Fields/FormDatePicker.vue';
import { getDefaultDate } from '@/utils/helpers';

defineEmits<ExpenseFormEmits>();
const props = defineProps<IncomeExpenseFormProps>();
const amount = computed(() => convertToDollar(props.expense?.data.amount));
</script>

<template>
    <div class="mb-6 grid grid-cols-2 gap-4">
        <FormInput label="Template" hidden :value="!!isTemplate" />
        <FormInput label="Name" :rules="['required']" :value="expense?.data.name" />
        <FormInput label="Amount" :rules="['required', 'float:2']" :value="amount" />
        <FormSelect
            :items="types"
            label="Account Type"
            item-label="name"
            item-value="id"
            :value="expense?.expense.id ?? ''"
            :rules="['required']"
        />
        <FormDatePicker label="Pay Date" :value="getDefaultDate(expense?.data.pay_date ?? '')" />
    </div>

    <ExpenseFormActions @close="$emit('close')" />
</template>
