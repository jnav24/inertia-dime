<script setup lang="ts">
import { computed, onBeforeUnmount, ref, watch } from 'vue';
import type { RulesType } from '@/types/form';
import FormLabel from '@/Components/Fields/FormLabel.vue';
import Calendar from '@/Components/Icons/outline/Calendar.vue';
import useForm from '@/Composables/useForm';
import FormDatePickerCalendar from '@/Components/Fields/FormDatePickerCalendar.vue';
import { formatTimeZone } from '@/utils/timestamp';

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

const container = ref<HTMLDivElement | null>(null);
const selected = ref(false);

const formatValue = computed(() => {
    if (!getInputValue.value) {
        return '';
    }

    return formatTimeZone('yyyy-MM-dd', 'UTC', getInputValue.value);
});

const offClickHandler = (e: Event) => {
    if (container.value && !container.value.contains(e.target as Node)) {
        selected.value = false;
    }
};

watch(selected, (v) => {
    if (v) {
        document.addEventListener('click', offClickHandler);
    } else {
        document.removeEventListener('click', offClickHandler);
    }
});

onBeforeUnmount(() => {
    document.removeEventListener('click', offClickHandler);
});
</script>

<template>
    <div :id="`date-picker-${labelId}`" ref="container">
        <FormLabel :error="error" labelId="labelId" :label="label" />

        <div class="relative mt-2" ref="datePicker">
            <div
                class="absolute left-0 top-0 flex h-full w-10 cursor-pointer flex-col items-center justify-center rounded-l-md bg-gray-600"
                @click="selected = !selected"
            >
                <Calendar classes="size-5 text-white" />
            </div>

            <input
                :id="labelId"
                class="w-full cursor-pointer rounded border py-2 pl-12 pr-2 text-gray-500 outline-none"
                :class="{
                    'border-gray-300 focus:border-primary': !error,
                    'border-red-600': error,
                }"
                type="text"
                :value="formatValue"
                autocomplete="off"
                @click="selected = !selected"
                :aria-labelledby="labelId"
                readonly
            />

            <FormDatePickerCalendar
                v-model:selected="selected"
                :value="formatValue"
                @update-value="updateInputValue($event)"
            />
        </div>

        <span v-if="error" class="text-sm text-red-600">{{ error }}</span>
    </div>
</template>
