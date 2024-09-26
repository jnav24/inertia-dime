<script setup lang="ts">
import FormLabel from '@/Components/Fields/FormLabel.vue';
import useForm from '@/Composables/useForm';
import type { RulesType } from '@/types/form';

type Props = {
    label: string;
    rules?: RulesType | Array<keyof RulesType>;
    validateOnInit?: boolean;
    value?: string;
};

const props = defineProps<Props>();

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
</script>

<template>
    <div>
        <FormLabel :error="error" labelId="labelId" :label="label" />
        <textarea
            :id="labelId"
            class="mt-2 w-full rounded border p-2 outline-none"
            :class="{
                'border-gray-300 focus:border-primary': !error,
                'border-red-600': error,
            }"
            :value="getInputValue"
            @blur="updateValue($event)"
            @input="updateValue($event)"
            :aria-labelledby="labelId"
        />
    </div>
</template>
