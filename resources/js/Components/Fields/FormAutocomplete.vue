<script setup lang="ts">
import FormInput from '@/Components/Fields/FormInput.vue';
import FormSelectOptions from '@/Components/Fields/FormSelectOptions.vue';
import { FormContext, FormContextType, RulesType } from '@/types/form';
import { inject } from 'vue';
import { debounce } from '@/utils/functions';

const formContext = inject<FormContextType>(FormContext, {} as FormContextType);

type SelectItems = Record<string, string>;

type Emits = {
    (e: 'search-value', v: string): void;
    (e: 'handle-selection', v: string): void;
};

type Props = {
    clearable?: boolean;
    hidden?: boolean;
    icon?: any;
    itemLabel?: string;
    items: SelectItems[];
    itemValue?: string;
    label: string;
    noAutocomplete?: boolean;
    onBlur?: boolean;
    password?: boolean;
    placeholder?: boolean;
    readOnly?: boolean;
    rules?: RulesType | Array<keyof RulesType>;
    validateOnInit?: boolean;
    value?: string;
};

const emit = defineEmits<Emits>();

const props = withDefaults(defineProps<Props>(), {
    itemLabel: 'label',
    itemValue: 'value',
});

const handleInputUpdate = (value: string | undefined) => {
    if (formContext) {
        debounce(() => formContext.validateSubmit(new Event('submit')));
        return;
    }

    emit('search-value', value || '');
};
</script>

<template>
    <div class="relative">
        <FormInput @update:value="handleInputUpdate" v-bind="props" />

        <FormSelectOptions
            @handle-selection="emit('handle-selection', $event)"
            :items="items"
            :itemLabel="itemLabel"
            :itemValue="itemValue"
            :show="!!items.length"
        >
            <template #default="{ item }">
                <slot v-if="$slots.default" :item="item" />
                <span v-else>{{ item[itemLabel] }}</span>
            </template>
        </FormSelectOptions>
    </div>
</template>
