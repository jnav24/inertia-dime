<script setup lang="ts">
import FormInput from '@/Components/Fields/FormInput.vue';
import FormSelectOptions from '@/Components/Fields/FormSelectOptions.vue';
import { FormContext, FormContextType, RulesType } from '@/types/form';
import { computed, ref, inject } from 'vue';
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

const isFocused = ref(false);
const search = ref('');

const filteredItems = computed(() =>
    props.items.filter((item) => {
        const label = item[props.itemLabel];
        const value = item[props.itemValue];
        return (
            label.toLowerCase().includes(search.value.toLowerCase()) ||
            value.toLowerCase().includes(search.value.toLowerCase())
        );
    }),
);
const showSelections = computed(
    () => isFocused.value && search.value.length > 0 && props.items.length > 0,
);

const debouncedSubmit = debounce(() => {
    if (search.value.length) {
        formContext.validateSubmit(new Event('submit'));
    }
}, 750);

const handleInputUpdate = (value: string | undefined) => {
    search.value = value || '';

    if (formContext && value?.length) {
        debouncedSubmit();
        return;
    }

    emit('search-value', value || '');
};

const handleSelection = (value: string) => {
    emit('handle-selection', value);
};
</script>

<template>
    <div class="relative z-50">
        <FormInput
            @handle-blur="isFocused = false"
            @handle-focus="isFocused = true"
            @update:value="handleInputUpdate"
            v-bind="props"
        />

        <FormSelectOptions
            @handle-selection="handleSelection"
            :items="filteredItems"
            :itemLabel="itemLabel"
            :itemValue="itemValue"
            :show="showSelections"
        >
            <template #default="{ item }">
                <slot v-if="$slots.default" :item="item" />
                <span v-else>{{ item[itemLabel] }}</span>
            </template>
        </FormSelectOptions>
    </div>
</template>
