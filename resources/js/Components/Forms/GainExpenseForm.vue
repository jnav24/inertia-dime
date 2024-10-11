<script setup lang="ts">
import { computed } from 'vue';
import { convertToDollar } from '@/utils/functions';
import FormInput from '@/Components/Fields/FormInput.vue';
import FormSelect from '@/Components/Fields/FormSelect.vue';
import ExpenseFormActions from '@/Components/Forms/ExpenseFormActions.vue';
import { ExpenseFormEmits, GainExpenseFormProps } from '@/types/expenses';

defineEmits<ExpenseFormEmits>();
const props = defineProps<GainExpenseFormProps>();
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
            :value="expense?.expense.id"
            :rules="['required']"
        />
    </div>

    <ExpenseFormActions @close="$emit('close')" />
</template>
