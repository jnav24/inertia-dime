<script setup lang="ts">
import Modal from '@/Components/modals/Modal.vue';

type Emits = {
    (e: 'update:show', v: boolean): void;
};

type Props = {
    show: boolean;
};

const emit = defineEmits<Emits>();
defineProps<Props>();

const closeModal = () => {
    emit('update:show', false);
};
</script>

<template>
    <Modal :show="show" @close-modal="closeModal()" hide-close-button persistent>
        <div class="w-200 space-y-4 p-4">Savings information here</div>
    </Modal>
</template>
