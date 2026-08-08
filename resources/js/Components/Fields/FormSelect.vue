<script setup lang="ts">
import FormLabel from '@/Components/Fields/FormLabel.vue';
import type { RulesType } from '@/types/form';
import ChevronDown from '@/Components/Icons/outline/ChevronDown.vue';
import { computed, ref, watch } from 'vue';
import useForm from '@/Composables/useForm';
import FormSelectOptions from '@/Components/Fields/FormSelectOptions.vue';

type Emits = {
    (e: 'handle-selection', v: string): void;
    (e: 'update:value', v: string): void;
};

type Props = {
    isDisabled?: boolean;
    itemLabel?: string;
    items: SelectItems[];
    itemValue?: string;
    label: string;
    placeholder?: string;
    rules?: RulesType | Array<keyof RulesType>;
    hideLabel?: boolean;
    tabIndex?: number;
    validateOnInit?: boolean;
    value: string;
};

type SelectItems = Record<string, string>;

const emit = defineEmits<Emits>();
const props = withDefaults(defineProps<Props>(), {
    itemLabel: 'label',
    itemValue: 'value',
    placeholder: 'Select',
    tabIndex: 0,
    validateOnInit: false,
});

const { error, labelId, getInputValue, updateInputValue } = useForm({
    label: props.label,
    validateOnInit: props.validateOnInit,
    value: props.value ?? '',
    rules: props.rules,
});

const selected = ref(false);

const getPlaceholder = computed(() => {
    const v = !labelId ? props.value : getInputValue.value;
    const obj: SelectItems =
        (props.items ?? []).find((obj: SelectItems) => v === obj[props.itemValue]) ?? {};

    if (obj?.[props.itemLabel]) {
        return obj[props.itemLabel];
    }

    return props.placeholder;
});

const disableField = computed(() => props.isDisabled || !props.items?.length);

watch(
    () => props.items,
    (newItems) => {
        const result = newItems.find((item) => item[props.itemValue] === props.value);
        updateInputValue(result?.[props.itemValue] ?? '');
    },
);

const handleBlur = () => {
    if (!disableField.value) {
        selected.value = false;
    }
};

const handleClick = () => {
    if (!disableField.value) {
        selected.value = !selected.value;
    }
};

const handleSelection = (value: string) => {
    if (selected.value) {
        emit('update:value', value);
        emit('handle-selection', value);
        updateInputValue(value);
    }
};
</script>

<template>
    <div>
        <FormLabel v-if="!hideLabel" :error="error" :labelId="labelId" :label="label" />

        <div
            class="relative mt-2 flex transform items-center justify-between rounded-md border border-solid px-2 py-2 outline-none"
            :class="{
                'border-red-600 bg-white text-red-600': error && !disableField,
                'dark:bg-dark-main cursor-pointer border-gray-300 bg-white text-gray-600 transition duration-300 hover:border-gray-600 hover:text-gray-700 focus:border-primary dark:border-gray-700':
                    !error && !disableField,
                'cursor-text border-gray-300 bg-gray-200 text-gray-500 dark:border-gray-600 dark:bg-gray-800':
                    disableField,
                'z-50': selected,
                'z-0': !selected,
            }"
            :tabindex="tabIndex"
            @blur="handleBlur()"
            @click="handleClick()"
        >
            <span class="flex-1 text-sm text-gray-500">{{ getPlaceholder }}</span>

            <ChevronDown
                classes="transform transition duration-300 size-4 ml-2"
                :class="{ 'rotate-180': selected, 'rotate-0': !selected }"
            />

            <FormSelectOptions
                @handle-selection="handleSelection"
                :items="items"
                :itemLabel="itemLabel"
                :itemValue="itemValue"
                :show="selected"
            >
                <template #default="{ item }">
                    <slot v-if="$slots.default" :item="item" />
                    <span v-else>{{ item[itemLabel] }}</span>
                </template>
            </FormSelectOptions>
        </div>

        <span v-if="error" class="text-sm text-red-600">{{ error }}</span>
    </div>
</template>
