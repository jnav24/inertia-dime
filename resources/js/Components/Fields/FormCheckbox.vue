<script setup lang="ts">
import type { RulesType } from '@/types/form';
import useForm from '@/Composables/useForm';
import Check from '@/Components/Icons/outline/Check.vue';
import FormLabel from '@/Components/Fields/FormLabel.vue';
import FormButton from '@/Components/Fields/FormButton.vue';

const props = defineProps<{
    label: string;
    defaultChecked?: boolean;
    rules?: RulesType | Array<keyof RulesType>;
    validateOnInit?: boolean;
}>();

const emit = defineEmits<{ (e: 'handleUpdate', checked: boolean): void }>();

const { error, labelId, getInputValue, updateInputValue } = useForm({
    label: props.label,
    validateOnInit: props.validateOnInit,
    value: props.defaultChecked ? 'checked' : '',
    rules: props.rules,
});

const updateValue = () => {
    const value = getInputValue.value === 'checked' ? '' : 'checked';
    updateInputValue(value);
    emit('handleUpdate', value === 'checked');
};
</script>

<template>
    <div class="flex flex-row items-center">
        <FormButton checkbox @click="updateValue" v-if="getInputValue !== 'checked'">
            <Check classes="size-4 text-white dark:text-gray-700" />
        </FormButton>

        <FormButton
            checkbox
            color="primary"
            @click="updateValue"
            v-if="getInputValue === 'checked'"
        >
            <Check classes="size-4" />
        </FormButton>

        <div class="ml-2">
            <FormLabel :error="error" :label="label" :labelId="labelId" />
        </div>
    </div>
</template>
