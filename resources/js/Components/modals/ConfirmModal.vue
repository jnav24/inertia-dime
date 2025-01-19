<script setup lang="ts">
import Modal from '@/Components/modals/Modal.vue';
import Typography from '@/Components/Elements/Typography.vue';
import FormButton from '@/Components/Fields/FormButton.vue';
import ExclamationTriangle from '@/Components/Icons/outline/ExclamationTriangle.vue';

type Emits = {
    (e: 'confirm-action'): void;
    (e: 'update:show', v: boolean): void;
};

type Props = {
    description?: string;
    show: boolean;
    title?: string;
};

const emit = defineEmits<Emits>();
withDefaults(defineProps<Props>(), {
    description: 'Are you sure you want to delete this item? This action cannot be undone.',
    title: 'Delete Item',
});

const confirmAction = () => {
    emit('confirm-action');
    emit('update:show', false);
};
</script>

<template>
    <Modal :show="show" @close-modal="$emit('update:show', false)" hide-close-button>
        <div class="w-100 p-4">
            <div class="mb-6 flex space-x-4">
                <div>
                    <div class="rounded-full bg-danger/25 p-2">
                        <ExclamationTriangle classes="size-6 text-danger" />
                    </div>
                </div>
                <div>
                    <Typography variant="h3">{{ title }}</Typography>
                    <Typography variant="body2">
                        {{ description }}
                    </Typography>
                </div>
            </div>

            <div class="flex justify-end space-x-2">
                <FormButton @onclick="$emit('update:show', false)">Cancel</FormButton>
                <FormButton color="danger" @onclick="confirmAction()">Confirm</FormButton>
            </div>
        </div>
    </Modal>
</template>
