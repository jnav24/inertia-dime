<script setup lang="ts">
import useForm from '@/Composables/useForm';
import type { RulesType } from '@/types/form';
import { computed, watch } from 'vue';

type Emits = {
    (e: 'update:toggle', v: boolean): void;
    (e: 'setToggle', v: boolean): void;
};

type Props = {
    label: string;
    validateOnInit?: boolean;
    rules?: RulesType | Array<keyof RulesType>;
    submit?: boolean;
    toggle: boolean;
};

const emit = defineEmits<Emits>();
const props = defineProps<Props>();

const { error, labelId, getInputValue, updateInputValue } = useForm({
    label: props.label,
    validateOnInit: props.validateOnInit,
    value: props.toggle ? 'checked' : '',
    rules: props.rules,
});

const isChecked = computed(() => getInputValue.value === 'checked');

const handleUpdate = () => {
    updateInputValue(isChecked.value ? '' : 'checked');
    emit('update:toggle', isChecked.value);
    emit('setToggle', isChecked.value);
};

watch(
    () => props.toggle,
    (nv) => {
        const checked = !nv ? '' : 'checked';
        if (getInputValue.value !== checked) {
            updateInputValue(checked);
        }
    },
);
</script>

<template>
    <div>
        <input type="hidden" :name="labelId" :id="labelId" :value="getInputValue" />
        <button
            @click="handleUpdate()"
            class="w-16 rounded-full border text-left shadow-inner transition-all duration-100 ease-in-out focus:outline-none"
            :class="{
                'border-primary border-opacity-50 bg-primary bg-opacity-50': isChecked,
                'border-gray-200 bg-gray-200': !isChecked,
            }"
            style="height: 2.15rem"
            :type="submit ? 'submit' : 'button'"
        >
            <span
                class="inline-block h-8 w-8 transform rounded-full bg-white transition duration-100 ease-in-out"
                :class="{
                    'translate-x-9/10': isChecked,
                    'translate-x-0': !isChecked,
                }"
            ></span>
        </button>
    </div>
</template>
