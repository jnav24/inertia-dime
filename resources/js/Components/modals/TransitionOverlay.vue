<script setup lang="ts">
type Emits = {
    (e: 'handle-close'): void;
};

defineEmits<Emits>();
</script>

<template>
    <div class="fixed inset-0">
        <div
            class="absolute inset-0 bg-black opacity-75"
            @click="$emit('handle-close')"
            role="button"
            tabindex="0"
        />
    </div>
</template>
