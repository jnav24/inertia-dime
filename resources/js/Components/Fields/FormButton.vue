<script setup lang="ts">
import { computed, inject } from 'vue';
import { FormContext, FormContextType } from '@/types/form';

type ButtonColor = 'default' | 'primary' | 'secondary' | 'danger';

const formContext = inject<FormContextType>(FormContext);

defineEmits<{ (e: ''): void }>();
const props = withDefaults(
    defineProps<{
        block?: boolean;
        checkbox?: boolean;
        color?: ButtonColor;
        disabled?: boolean;
        fab?: boolean;
        filled?: boolean;
        submit?: boolean;
        size?: 'xs' | 'sm' | 'md' | 'lg';
    }>(),
    { color: 'default' },
);

const isDisabled = computed(() => props.disabled || formContext?.isSubmitting?.value || false);

const validateSubmit = () => {};
</script>

<template>
    <button
        class="focus:shadow-outline rounded transition duration-150 focus:outline-none"
        :class="{
            'border border-gray-300 bg-white text-gray-700 hover:bg-gray-100 active:bg-gray-200':
                color === 'default' && !isDisabled,
            'active:bg-dark-primary bg-primary text-white hover:bg-opacity-85':
                color === 'primary' && !isDisabled,
            'active:bg-dark-secondary bg-secondary text-gray-700 hover:bg-opacity-85':
                color === 'secondary' && !isDisabled,
            'active:bg-dark-danger bg-danger hover:bg-opacity-85':
                color === 'danger' && !isDisabled,
            'rounded-full p-2': fab,
            'rounded-md p-1': checkbox,
            'rounded-md px-6 py-3 text-sm': !fab && !checkbox,
            'cursor-text bg-gray-300 text-gray-700': isDisabled,
            'w-full': block,
        }"
        :disabled="isDisabled"
        @click="validateSubmit"
        :type="submit ? 'submit' : 'button'"
    >
        <span class="flex flex-row items-center justify-center">
            <slot />
        </span>
    </button>
</template>
