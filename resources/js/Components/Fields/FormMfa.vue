<script setup lang="ts">
import FormLabel from '@/Components/Fields/FormLabel.vue';
import useForm from '@/Composables/useForm';
import type { RulesType } from '@/types/form';
import { onMounted, ref } from 'vue';

type Props = {
    inputs?: number;
    label: string;
    readOnly?: boolean;
    rules?: RulesType | Array<keyof RulesType>;
    validateOnInit?: boolean;
    value?: string | boolean | number;
};

const emit = defineEmits<{ (e: 'update:value', value: string): void }>();
const props = withDefaults(defineProps<Props>(), { inputs: 6 });

const { error, labelId, getInputValue, updateInputValue } = useForm({
    label: props.label,
    validateOnInit: props.validateOnInit,
    value: props.value || '',
    rules: props.rules,
});

const inputRefs = ref([]);

const focusInputRef = (i: number) => {
    if (inputRefs.value[i]) {
        inputRefs.value[i].focus();
    }
};

const selectInputRef = (i: number) => {
    if (inputRefs.value[i]) {
        inputRefs.value[i].select();
    }
};

const getInputRef = (i: number) => {
    return inputRefs.value[i]?.value || '';
};

const setInputRef = (i: number) => {
    return (el) => {
        inputRefs.value[i] = el;
    };
};

const updateOnBlur = (e: FocusEvent, i: number) => {};

const updateValue = (e: Event, i: number) => {
    let extras = [];
    let jumpTo = 0;

    const values = inputRefs.value.map((item) => {
        selectInputRef(i);

        if (item.value.length > 1) {
            jumpTo = item.value.length;
            extras = item.value.split('');
        }

        if (extras.length) {
            item.value = extras.length ? extras.shift() : '';
        }

        return item.value;
    });

    const output = values.join('');

    updateInputValue(output);
    focusInputRef(jumpTo || i + 1);
};

onMounted(() => {
    focusInputRef(0);
});
</script>

<template>
    <div class="relative">
        <FormLabel v-if="!placeholder" :error="error" labelId="labelId" :label="label" />

        <div class="relative mb-2">
            <div class="flex space-x-2">
                <div class="w-12" v-for="(_item, idx) in inputs" :key="idx">
                    <input
                        :id="labelId"
                        class="mt-2 w-full rounded border p-2 text-center outline-none"
                        :class="{
                            'border-gray-300 focus:border-primary': !error,
                            'border-red-600': error,
                            'bg-gray-200 text-gray-500 dark:bg-gray-700': readOnly,
                        }"
                        type="text"
                        :ref="setInputRef(idx)"
                        :value="getInputRef(idx)"
                        autocomplete="off"
                        @focus="selectInputRef(idx)"
                        @blur="updateOnBlur($event, idx)"
                        @input="updateValue($event, idx)"
                        :aria-labelledby="labelId"
                        :readonly="readOnly"
                    />
                </div>
            </div>

            <span v-if="error" class="text-sm text-red-600">{{ error }}</span>
        </div>
    </div>
</template>
