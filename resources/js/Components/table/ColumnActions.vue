<script setup lang="ts">
import FormButton from '@/Components/Fields/FormButton.vue';
import Pencil from '@/Components/Icons/outline/Pencil.vue';
import Trash from '@/Components/Icons/outline/Trash.vue';
import { UserVehicle, ValueOfExpense } from '@/types/expenses';

defineEmits<{ (e: 'action-event', v: { type: string; obj: any }): void }>();
withDefaults(defineProps<{ hideActions?: boolean; obj: ValueOfExpense | UserVehicle }>(), { hideActions: false });
</script>

<template>
    <div class="flex space-x-2" v-if="!hideActions">
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
