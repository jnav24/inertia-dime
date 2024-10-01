<script setup lang="ts">
import { computed, ref } from 'vue';
import {
    addMonth,
    formatDate,
    formatTimeZone,
    getEndDayOfMonth,
    getStartDayOfMonth,
} from '@/utils/timestamp';
import FormButton from '@/Components/Fields/FormButton.vue';
import ChevronLeft from '@/Components/Icons/outline/ChevronLeft.vue';
import ChevronRight from '@/Components/Icons/outline/ChevronRight.vue';

type Emits = {
    (e: 'update:selected', v: boolean): void;
    (e: 'update-value', v: string): void;
};

type Props = {
    selected: boolean;
    value: string;
};

const emit = defineEmits<Emits>();
const props = defineProps<Props>();

const days = ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'];
const today = formatTimeZone('yyyy-MM-dd');

const dateCounter = ref(0);

const dayBegins = computed(() =>
    formatDate(
        'EEEEEE',
        getStartDayOfMonth(addMonth(dateCounter.value, props.value).toISOString()).toISOString(),
    ),
);

const dateHeader = computed(() =>
    formatDate('yyyy-MM', addMonth(dateCounter.value, props.value).toISOString()),
);

const daysList = computed(() => {
    const buffer = Array.from(Array(days.indexOf(dayBegins.value)).keys(), (num) => 60 + num);
    const daysOfTheMonth = Array.from(
        Array(
            +formatDate(
                'd',
                getEndDayOfMonth(
                    addMonth(dateCounter.value, props.value).toISOString(),
                ).toISOString(),
            ),
        ).keys(),
    );

    return buffer.concat(daysOfTheMonth);
});

const isSelected = (day: number) => {
    const result = `${dateHeader.value}-${setDay(day)}`;
    return formatTimeZone('yyyy-MM-dd', 'UTC', props.value) === result;
};

const isToday = (day: number) => {
    const result = `${formatTimeZone('yyyy-MM', 'UTC', dateHeader.value)}-${setDay(day)}`;
    return today === result;
};

const setDay = (day: number) => (day < 10 ? `0${day}` : day);

const updateValue = (day: number) => {
    const inputValue = `${dateHeader.value}-${setDay(day)}`;
    emit('update:selected', false);
    emit('update-value', inputValue);
};
</script>

<template>
    <div
        class="absolute left-0 top-0 z-50 min-h-64 w-64 origin-top-left translate-y-12 transform bg-white px-4 py-3 shadow-2xl transition duration-200 ease-out"
        :class="{
            'scale-100 opacity-100': selected,
            'scale-0 opacity-0': !selected,
        }"
    >
        <div class="flex flex-row items-center justify-between text-gray-700">
            <FormButton fab @click="dateCounter--">
                <ChevronLeft classes="size-4" />
            </FormButton>
            <span class="text-sm">
                {{ formatTimeZone('MMMM yyyy', 'UTC', dateHeader) }}
            </span>
            <FormButton fab @click="dateCounter++">
                <ChevronRight classes="size-4" />
            </FormButton>
        </div>

        <div class="my-2 grid grid-cols-7 gap-1">
            <span
                class="text-center text-sm text-gray-500"
                v-for="(day, index) in days"
                :key="index"
            >
                {{ day }}
            </span>
        </div>

        <div class="grid grid-cols-7 gap-1">
            <div v-for="(date, index) in daysList" :key="index">
                <span v-if="date > 31">&nbsp;</span>
                <button
                    v-if="date < 32"
                    class="focus:shadow-outline w-full rounded-full py-1 text-center text-sm focus:outline-none"
                    :class="{
                        'border-0 bg-white text-gray-600 hover:bg-gray-200':
                            !isSelected(date + 1) && !isToday(date + 1),
                        'border-0 bg-primary text-white': isSelected(date + 1),
                        'bg-gray-200 text-primary shadow-inner':
                            isToday(date + 1) && !isSelected(date + 1),
                    }"
                    @click="updateValue(date + 1)"
                    type="button"
                >
                    {{ date + 1 }}
                </button>
            </div>
        </div>
    </div>
</template>
