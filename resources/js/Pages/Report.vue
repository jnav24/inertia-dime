<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AuthenticatedContentLayout from '@/Layouts/AuthenticatedContentLayout.vue';
import { Head } from '@inertiajs/vue3';
import Card from '@/Components/Elements/Card.vue';
import BudgetForm from '@/Components/Fields/BudgetForm.vue';
import FormInput from '@/Components/Fields/FormInput.vue';
import FormSelect from '@/Components/Fields/FormSelect.vue';
import FormButton from '@/Components/Fields/FormButton.vue';
</script>

<template>
    <Head title="Reports" />

    <AuthenticatedLayout>
        <template #header> Reports </template>

        <AuthenticatedContentLayout>
            <Card>
                <BudgetForm>
                    <div class="grid grid-cols-5 gap-4">
                        <FormSelect
                            label="Expense Type"
                            :items="[]"
                            value=""
                            :rules="['required']"
                        />
                        <FormSelect label="Year" :items="[]" value="" :rules="['required']" />
                        <FormSelect label="Incomes Type" :items="[]" value="" />
                        <FormInput label="Keywords" value="" />
                        <div class="pt-8">
                            <FormButton block color="primary" submit>Search</FormButton>
                        </div>
                    </div>
                </BudgetForm>
            </Card>
        </AuthenticatedContentLayout>
    </AuthenticatedLayout>
</template>
