import type { FormContextType, RulesType } from '@/types/form';
import { FormContext } from '@/types/form';
import { computed, inject, ref } from 'vue';

type Props = {
    label: string;
    rules?: RulesType | Array<keyof RulesType>;
    validateOnInit: boolean;
    value: string;
};

export default function useForm({ label, rules, validateOnInit, value }: Props) {
    const formContext = inject<FormContextType>(FormContext);
    const labelId = ref('');

    if (label && !!formContext && Object.keys(formContext).length) {
        labelId.value = formContext.setupForm(label, rules);
        formContext.validateField(labelId.value, value, validateOnInit);
    }

    const error = computed(() => {
        if (formContext && formContext.formElements[labelId.value]) {
            return formContext.formElements[labelId.value].error;
        }

        return null;
    });

    const updateInputValue = (value: string) => {
        if (formContext && !!Object.keys(formContext).length) {
            formContext.validateField(labelId.value, value, true);
        }
    };

    const getInputValue = computed(() => {
        return formContext?.formElements?.[labelId.value].value ?? value;
    });

    return { error, labelId: labelId.value, getInputValue, updateInputValue };
}
