<script setup lang="ts">
import FormInput from '@/Components/Fields/FormInput.vue';
import ExpenseFormActions from '@/Components/Forms/ExpenseFormActions.vue';
import FormSelect from '@/Components/Fields/FormSelect.vue';
import ExpenseFormConfirmation from '@/Components/Forms/ExpenseFormConfirmation.vue';
import { CommonExpenseFormProps, ExpenseFormEmits } from '@/types/expenses';
import { computed } from 'vue';
import { convertToDollar } from '@/utils/functions';
import { dueDates } from '@/utils/helpers';

defineEmits<ExpenseFormEmits>();
const props = defineProps<CommonExpenseFormProps>();
const amount = computed(() => convertToDollar(props.expense?.data.amount));
</script>

<template>
    <div class="mb-6 grid grid-cols-2 gap-4">
        <FormInput label="Template" hidden :value="!!isTemplate" />
        <FormInput label="Account Type" hidden :value="types[0].id" />
        <FormInput label="Name" :rules="['required', 'min:3']" :value="expense?.data.name" />
        <FormInput label="Amount" :rules="['required', 'float:2']" :value="amount" />
        <FormSelect
            v-if="isTemplate"
            :items="dueDates as unknown as Record<string, string>[]"
            label="Due Date"
            :value="(expense?.data.due_date ?? 1).toString()"
        />
    </div>

    <ExpenseFormConfirmation v-if="!isTemplate" :expense="expense" />
    <ExpenseFormActions @close="$emit('close')" />
</template>
