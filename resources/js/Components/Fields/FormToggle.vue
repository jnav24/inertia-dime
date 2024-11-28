<script setup lang="ts">
type Emits = {
    (e: 'update:toggle', v: boolean): void;
    (e: 'setToggle', v: boolean): void;
};

type Props = {
    disabled?: boolean;
    toggle: boolean;
};

const emit = defineEmits<Emits>();
const props = defineProps<Props>();

const handleUpdate = () => {
    if (!props.disabled) {
        emit('update:toggle', !props.toggle);
        emit('setToggle', !props.toggle);
    }
};
</script>

<template>
    <button
        @click="handleUpdate()"
        class="w-16 rounded-full border text-left shadow-inner transition-all duration-100 ease-in-out focus:outline-none"
        :class="{
            'border-primary border-opacity-50 bg-primary bg-opacity-50': toggle,
            'border-gray-200 bg-gray-200': !toggle,
        }"
        style="height: 2.15rem"
        type="button"
    >
        <span
            class="inline-block h-8 w-8 transform rounded-full bg-white transition duration-100 ease-in-out"
            :class="{ 'translate-x-9/10': toggle, 'translate-x-0': !toggle }"
        ></span>
    </button>
</template>
