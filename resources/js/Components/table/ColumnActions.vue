<script setup lang="ts">
import FormButton from '@/Components/Fields/FormButton.vue';
import Pencil from '@/Components/Icons/outline/Pencil.vue';
import Trash from '@/Components/Icons/outline/Trash.vue';

type Props = {
    obj: any;
};

defineEmits<{ (e: 'action-event', v: { type: string; obj: any }): void }>();
defineProps<Props>();
</script>

<template>
    <div class="flex space-x-2">
        <FormButton
            :icon="Pencil"
            fab
            @click="$emit('action-event', { type: 'edit', obj })"
        ></FormButton>
        <FormButton
            :icon="Trash"
            fab
            @click="$emit('action-event', { type: 'delete', obj })"
        ></FormButton>
    </div>
</template>
