<script setup lang="ts">
import Modal from '@/Components/modals/Modal.vue';
import Typography from '@/Components/Elements/Typography.vue';
import FormButton from '@/Components/Fields/FormButton.vue';
import BudgetForm from '@/Components/Fields/BudgetForm.vue';
import FormSelect from '@/Components/Fields/FormSelect.vue';

type Emits = {
    (e: 'update:show'): void;
};

type Props = {
    show: boolean;
};

defineEmits<Emits>();
const props = defineProps<Props>();
</script>

<template>
    <Modal :show="show" @close-modal="$emit('update:show', false)" hide-close-button>
        <BudgetForm>
            <div class="w-100">
                <div class="mb-4 space-y-4 p-4">
                    <Typography variant="h2">Create Budget</Typography>

                    <div class="mb-4 grid grid-cols-2 gap-3">
                        <FormSelect :items="[]" label="Month" value="" />
                        <FormSelect :items="[]" label="Year" value="" />
                    </div>
                </div>

                <div
                    class="border-lm-stroke flex flex-row items-end justify-end space-x-2 rounded-b-lg border-t-2 p-4"
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
