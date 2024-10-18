<script setup lang="ts">
import { ExpenseFormEmits } from '@/types/expenses';
import ExpenseFormActions from '@/Components/Forms/ExpenseFormActions.vue';
import FormInput from '@/Components/Fields/FormInput.vue';

type Props = {
    data: {
        color?: string;
        make?: string;
        model?: string;
        year?: number;
        license?: string;
    };
};

defineEmits<ExpenseFormEmits>();
defineProps<Props>();
</script>

<template>
    <div class="mb-6 grid grid-cols-2 gap-4">
        <FormInput label="Color" :value="data?.color" :rules="['required']" />
        <FormInput
            label="Year"
            :value="data?.year?.toString()"
            :rules="['required', 'numeric', 'eq:4']"
        />
        <FormInput label="Make" :value="data?.make" :rules="['required']" />
        <FormInput label="Model" :value="data?.model" :rules="['required']" />
        <FormInput label="License" :value="data?.license" />
    </div>

    <ExpenseFormActions @close="$emit('close')" />
</template>
