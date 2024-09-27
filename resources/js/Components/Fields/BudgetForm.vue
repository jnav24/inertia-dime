<script setup lang="ts">
import type { FormContextType, FormElementValidationType, RulesType } from '@/types/form';
import { FormContext } from '@/types/form';
import { validateRules } from '@/utils/form-validator';
import { provide, reactive, ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Alert from '@/Components/Elements/Alert.vue';

type FormMethod = 'post' | 'get' | 'patch' | 'delete' | 'put';

const props = withDefaults(
    defineProps<{ action?: string; method?: FormMethod; valid?: boolean | undefined }>(),
    { action: '', method: 'post', valid: undefined },
);
const emit = defineEmits<{
    (e: 'handleSubmit', event: Event): void;
    (e: 'update:valid', event: boolean): void;
    (e: 'handleError', event: Record<string, string>): void;
    (e: 'handleSuccess', event: any): void;
}>();

const form = useForm({});

const formElements = reactive({} as Record<string, FormElementValidationType>);

let matchFields: Record<string, string> = {};

const isSubmitting = ref(false);
const isValid = ref(false);

const setFormElement = (
    name: string,
    rules: RulesType | Array<keyof RulesType>,
    value = '',
): void => {
    formElements[name] = {
        rules,
        valid: !Object.keys(rules).length,
        error: null,
        value,
    };
};

const setFormId = (name: string): string => name.toLowerCase().replace(/\s+/g, '_');

const getMatchId = (rules: RulesType | Array<keyof RulesType>) => {
    let matchId: string | null = null;

    if (Array.isArray(rules)) {
        const values = Object.values(rules).filter((str) => str.includes('match'));

        if (values.length && values[0].includes(':')) {
            matchId = values[0].split(':')[1];
        }
    } else {
        const keys = Object.keys(rules).filter((str) => str.includes('match'));

        if (keys.length && keys[0].includes(':')) {
            matchId = keys[0].split(':')[1];
        }
    }

    return matchId;
};

const setMatchFields = (labelId: string, rules: RulesType | Array<keyof RulesType>) => {
    const result: Record<string, string> = {};
    const matchId = getMatchId(rules);

    if (matchId) {
        result[matchId] = labelId;
    }

    return result;
};

const setupForm = (label: string, rules: RulesType | Array<keyof RulesType> = {}) => {
    const labelId = setFormId(label);
    setFormElement(labelId, rules);
    matchFields = {
        ...matchFields,
        ...setMatchFields(labelId, rules),
    };
    return labelId;
};

const isFormValid = () => {
    const keys = Object.keys(formElements);
    const valid = Object.values(formElements).filter(
        (elem: { valid: boolean; rules: RulesType | Array<keyof RulesType> }) => elem.valid,
    );
    isValid.value = keys.length === valid.length;

    if (props.valid !== undefined) {
        emit('update:valid', isValid.value);
    }
};

const setMatchRules = (rules: RulesType | (keyof RulesType)[]) => {
    const valuesIndex = (
        Array.isArray(rules) ? Object.values(rules) : Object.keys(rules)
    ).findIndex((rule) => rule.includes('match'));

    const matchKey = Object.keys(rules).filter((str) =>
        str.includes('match'),
    ) as (keyof RulesType)[];

    if (matchKey.length) {
        const result: RulesType = { ...rules };
        const formName = matchKey[0].split(':')[1];
        delete result[matchKey[0]];
        return {
            ...result,
            [`match:${formName}|${formElements[formName].value}`]: (rules as RulesType)[
                matchKey[0]
            ],
        };
    }

    if (valuesIndex > -1) {
        const result = { ...rules };
        const formName = (result as Array<keyof RulesType>)[valuesIndex].split(':')[1];
        (result as Array<keyof RulesType>)[valuesIndex] =
            `match:${formName}|${formElements[formName].value}`;
        return result;
    }

    return rules;
};

const validateField = (labelId: string, value: string, initialize = false): string | null => {
    if (!labelId || !labelId.length || !formElements[labelId]) {
        return null;
    }

    const { rules } = formElements[labelId];
    const { error, valid } = validateRules(value, setMatchRules(rules));

    formElements[labelId] = {
        ...formElements[labelId],
        valid,
        value,
    };

    if (initialize) {
        formElements[labelId] = {
            ...formElements[labelId],
            error,
        };
    }

    if (matchFields[labelId] && formElements[matchFields[labelId]]) {
        validateField(matchFields[labelId], formElements[matchFields[labelId]].value);
    }

    isFormValid();
    return error;
};

const validateAllFields = () => {
    for (const [key, obj] of Object.entries(formElements)) {
        validateField(key, obj.value, true);
    }
};

const getFormData = () => {
    return Object.entries(formElements).reduce((result, [key, obj]) => {
        return {
            ...result,
            [key]: obj.value,
        };
    }, {});
};

const validateSubmit = (e: Event) => {
    if (!isSubmitting.value) {
        isSubmitting.value = true;

        if (isValid.value) {
            emit('handleSubmit', e);
            form.transform((data) => ({ ...data, ...getFormData() })).submit(
                props.method,
                props.action,
                {
                    onBefore: (e) => emit('handleBefore', e),
                    onCancel: (e) => emit('handleCancel', e),
                    onError: (e) => emit('handleError', e),
                    onFinish: (e) => emit('handleFinish', e),
                    onProgress: (e) => emit('handleProgress', e),
                    onStart: (e) => emit('handleStart', e),
                    onSuccess: (e) => emit('handleSuccess', e),
                },
            );
            isSubmitting.value = false;
            return true;
        }

        validateAllFields();
        isSubmitting.value = false;
    }
};

const resetFields = () => {};

provide<FormContextType>(FormContext, {
    formElements,
    isSubmitting,
    setupForm,
    validateField,
    validateAllFields,
    resetFields,
});
</script>

<template>
    <form :action="action" :method="method" @submit.prevent="validateSubmit">
        <Alert
            v-if="form.hasErrors"
            type="error"
            :message="Object.values(form.errors)[0] as string"
            title="Error"
        />
        <slot />
    </form>
</template>
