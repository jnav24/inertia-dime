<script setup lang="ts">
import type { RulesType } from '@/types/form';
import useForm from '@/Composables/useForm';
import FormLabel from '@/Components/Fields/FormLabel.vue';
import { resolveComponent } from 'vue';

const emit = defineEmits<{ (e: 'update:value', value: string | undefined): void }>();
const props = withDefaults(
    defineProps<{
        hidden?: boolean;
        icon?: any;
        label: string;
        noAutocomplete?: boolean;
        onBlur?: boolean;
        password?: boolean;
        placeholder?: boolean;
        readOnly?: boolean;
        rules?: RulesType | Array<keyof RulesType>;
        validateOnInit?: boolean;
        value?: string;
    }>(),
    { onBlur: true, validateOnInit: false, value: undefined },
);

const { error, labelId, getInputValue, updateInputValue } = useForm({
    label: props.label,
    validateOnInit: props.validateOnInit,
    value: props.value ?? '',
    rules: props.rules,
});

const updateValue = (event: Event) => {
    const { value } = event.target as HTMLInputElement;
    updateInputValue(value);

    if (props.value) {
        emit('update:value', value);
    }
};

const updateOnBlur = (event: FocusEvent) => {
    if (props.onBlur) {
        return updateValue(event);
    }

    return null;
};

const setIcon = () => {
    if (typeof props.icon === 'string') {
        return resolveComponent(props.icon);
    }

    return props.icon;
};
</script>

<template>
    <div class="relative" v-show="!hidden">
        <FormLabel v-if="!placeholder" :error="error" labelId="labelId" :label="label" />

        <div class="relative mb-2">
            <div
                class="absolute left-0 top-1 flex h-full w-10 flex-row items-center justify-center"
                v-if="icon"
            >
                <component :is="setIcon()" class="size-4 text-gray-600" />
            </div>

            <input
                :id="labelId"
                class="mt-2 w-full rounded border p-2 outline-none"
                :class="{
                    'border-gray-300 focus:border-primary': !error,
                    'border-red-600': error,
                    'bg-gray-200 text-gray-500 dark:bg-gray-700': readOnly,
                    'pl-8': icon,
                }"
                :type="password ? 'password' : 'text'"
                :value="getInputValue"
                :autocomplete="noAutocomplete || password ? 'on' : 'off'"
                @blur="updateOnBlur($event)"
                @input="updateValue($event)"
                :aria-labelledby="labelId"
                :readonly="readOnly || hidden"
                :placeholder="placeholder ? label : ''"
            />

            <span v-if="error" class="text-sm text-red-600">{{ error }}</span>
        </div>
    </div>
</template>
