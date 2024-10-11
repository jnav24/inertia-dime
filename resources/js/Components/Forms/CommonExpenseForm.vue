<script setup lang="ts">
import { computed } from 'vue';
import { dueDates } from '@/utils/helpers';
import { convertToDollar } from '@/utils/functions';
import FormInput from '@/Components/Fields/FormInput.vue';
import ExpenseFormActions from '@/Components/Forms/ExpenseFormActions.vue';
import FormSelect from '@/Components/Fields/FormSelect.vue';
import ExpenseFormConfirmation from '@/Components/Forms/ExpenseFormConfirmation.vue';
import { ExpenseFormEmits, CommonExpenseFormProps } from '@/types/expenses';

defineEmits<ExpenseFormEmits>();
const props = defineProps<CommonExpenseFormProps>();
const amount = computed(() => convertToDollar(props.expense?.data.amount));
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
            :rules="['required']"
            :value="expense?.expense.id"
        />
        <FormSelect
            v-if="isTemplate"
            :items="dueDates"
            label="Due Date"
            :value="expense?.data.due_date ?? 1"
        />
    </div>

    <ExpenseFormConfirmation v-if="!isTemplate" :expense="expense" />
    <ExpenseFormActions @close="$emit('close')" />
</template>
