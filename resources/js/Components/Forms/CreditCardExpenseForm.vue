<script setup lang="ts">
import { computed } from 'vue';
import { convertToDollar } from '@/utils/functions';
import { dueDates } from '@/utils/helpers';
import { ExpenseFormEmits, GainExpenseFormProps } from '@/types/expenses';
import FormInput from '@/Components/Fields/FormInput.vue';
import ExpenseFormActions from '@/Components/Forms/ExpenseFormActions.vue';
import FormSelect from '@/Components/Fields/FormSelect.vue';
import ExpenseFormConfirmation from '@/Components/Forms/ExpenseFormConfirmation.vue';

defineEmits<ExpenseFormEmits>();
const props = defineProps<GainExpenseFormProps>();
const amount = computed(() => convertToDollar(props.expense?.data.amount));
const balance = computed(() => convertToDollar(props.expense?.data.balance));
const limit = computed(() => convertToDollar(props.expense?.data.limit));
</script>

<template>
    <div class="mb-6 grid grid-cols-2 gap-4">
        <FormInput label="Template" hidden :value="!!isTemplate" />
        <FormInput label="Name" :rules="['required', 'min:3']" :value="expense?.data.name" />
        <FormInput label="Amount" :rules="['required', 'float:2']" :value="amount" />
        <FormSelect
            :items="types"
            label="Account Type"
            item-label="name"
            item-value="id"
            :value="expense?.expense.id"
            :rules="['required']"
        />
        <FormInput label="Balance" :rules="['required', 'float:2']" :value="balance" />
        <FormSelect
            v-if="isTemplate"
            :items="dueDates"
            label="Due Date"
            :value="expense?.data.due_date ?? 1"
        />
    </div>

    <div class="mt-4 grid grid-cols-2 gap-4">
        <FormInput label="Limit" :value="limit" />
        <FormInput label="APR" :value="expense?.data.apr" />
    </div>

    <div class="mt-4 grid grid-cols-3 gap-4">
        <FormInput label="Last 4" :value="expense?.data.last_4" />
        <FormInput label="Exp Month" :value="expense?.data.exp_month" />
        <FormInput label="Exp Year" :value="expense?.data.exp_year" />
    </div>

    <ExpenseFormConfirmation v-if="!isTemplate" :expense="expense" />
    <ExpenseFormActions @close="$emit('close')" />
</template>
