<script setup lang="ts">
import { computed } from 'vue';
import { convertToDollar } from '@/utils/functions';
import { ExpenseFormEmits, GainExpenseFormProps } from '@/types/expenses';
import FormInput from '@/Components/Fields/FormInput.vue';
import ExpenseFormActions from '@/Components/Forms/ExpenseFormActions.vue';
import FormSelect from '@/Components/Fields/FormSelect.vue';
import ExpenseFormConfirmation from '@/Components/Forms/ExpenseFormConfirmation.vue';

defineEmits<ExpenseFormEmits>();
const props = defineProps<GainExpenseFormProps>();
const amount = computed(() => convertToDollar(props.expense?.data.amount));
</script>

<template>
    <div class="mb-6 grid grid-cols-2 gap-4">
        <FormInput label="Name" :rules="['required', 'min:3']" />
        <FormInput label="Amount" :rules="['required', 'float:2']" />
        <FormSelect :items="[]" label="Account Type" value="" :rules="['required']" />
        <FormInput label="Account Balance" :rules="['required', 'float:2']" />
        <FormSelect :items="[]" label="Due Date" value="" />
    </div>

    <div class="mt-4 grid grid-cols-2 gap-4">
        <FormInput label="Credit Limit" />
        <FormInput label="APR" />
        <FormInput label="Last 4 Numbers" />
        <FormInput label="Expiration Month" />
        <FormInput label="Expiration Year" />
    </div>

    <ExpenseFormConfirmation />
    <ExpenseFormActions @close="$emit('close')" />
</template>
