<script lang="ts" setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AuthenticatedContentLayout from '@/Layouts/AuthenticatedContentLayout.vue';
import Tabs from '@/Components/tabs/Tabs.vue';
import TabItem from '@/Components/tabs/TabItem.vue';
import FormAutocomplete from '@/Components/Fields/FormAutocomplete.vue';
import DividendSearchModal from '@/Components/modals/DividendSearchModal.vue';
import MagnifyingGlass from '@/Components/Icons/outline/MagnifyingGlass.vue';
import BudgetForm from '@/Components/Fields/BudgetForm.vue';
import { PageProps } from '@/types/providers';
import Typography from '@/Components/Elements/Typography.vue';

type Props = PageProps & {
    items: any[];
};

const props = defineProps<Props>();

const dividend = ref({});
const showModal = ref(false);

const handleSelection = (event: any) => {
    dividend.value = props.items.find((item) => item.symbol === event);
    showModal.value = true;
};
</script>

<template>
    <Head title="Dividends" />

    <AuthenticatedLayout>
        <template #header> Dividends </template>

        <AuthenticatedContentLayout>
            <DividendSearchModal
                @update:show="showModal = $event"
                :dividend="dividend"
                :show="showModal"
            />

            <div class="flex justify-end">
                <div class="w-1/3">
                    <BudgetForm :action="route('dividends.search')">
                        <FormAutocomplete
                            @handle-selection="handleSelection"
                            :icon="MagnifyingGlass"
                            :items="items"
                            item-label="company_name"
                            item-value="symbol"
                            label="Search"
                            clearable
                            placeholder
                        >
                            <template #default="{ item }">
                                <div
                                    class="flex cursor-pointer items-center space-x-2 hover:bg-gray-200"
                                >
                                    <div>
                                        <img :src="item.image" alt="" class="h-8 w-8" />
                                    </div>
                                    <div>
                                        <Typography variant="body1">{{ item.symbol }}</Typography>
                                        <Typography variant="caption">{{
                                            item.company_name
                                        }}</Typography>
                                    </div>
                                </div>
                            </template>
                        </FormAutocomplete>
                    </BudgetForm>
                </div>
            </div>

            <Tabs>
                <TabItem title="Holdings">Holdings</TabItem>
                <TabItem title="Payouts">Payouts</TabItem>
            </Tabs>
        </AuthenticatedContentLayout>
    </AuthenticatedLayout>
</template>
