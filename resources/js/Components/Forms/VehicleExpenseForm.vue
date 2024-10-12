<script setup lang="ts">
import FormInput from '@/Components/Fields/FormInput.vue';
import ExpenseFormActions from '@/Components/Forms/ExpenseFormActions.vue';
import FormSelect from '@/Components/Fields/FormSelect.vue';
import ExpenseFormConfirmation from '@/Components/Forms/ExpenseFormConfirmation.vue';
import { ExpenseFormEmits, UserVehicleExpenseFormProps } from '@/types/expenses';
import { computed, ref } from 'vue';
import { convertToDollar } from '@/utils/functions';
import { dueDates } from '@/utils/helpers';

defineEmits<ExpenseFormEmits>();
const props = defineProps<UserVehicleExpenseFormProps>();
const typeSelected = ref('');
const amount = computed(() => convertToDollar(props.expense?.data.amount));
const balance = computed(() => convertToDollar(props.expense?.data.balance));
const isMileage = computed(() => {
    return props.types.find((item) => item.id === typeSelected.value)?.slug === 'gas';
});
</script>

<template>
    <div class="mb-6 grid grid-cols-2 gap-4">
        <FormSelect :items="[]" label="Vehicle" value="" :rules="['required']" />
        <FormInput label="Amount" :rules="['required', 'float:2']" :value="amount" />
        <FormSelect
            :items="types"
            label="Account Type"
            item-label="name"
            item-value="id"
            :value="expense?.expense.id"
            :rules="['required']"
            @handle-selection="typeSelected = $event"
        />
        <FormInput label="Balance" :rules="['required', 'min:3']" :value="balance" />
        <FormInput
            label="Mileage"
            v-if="isMileage"
            :rules="['required', 'min:3']"
            :value="expense?.data.mileage"
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
