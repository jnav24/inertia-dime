<script lang="ts" setup>
import { computed, ref } from 'vue';
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
import Table from '@/Components/table/Table.vue';
import { convertToCurrency, convertToPercentage } from '@/utils/functions';
import ColumnBasic from '@/Components/table/ColumnBasic.vue';
import Settings from '@/Components/Icons/outline/Settings.vue';
import FormButton from '@/Components/Fields/FormButton.vue';

type Props = PageProps & {
    items: { data: any[] };
    results: { data: any[] };
};

const props = defineProps<Props>();

const dividend = ref({});
const showModal = ref(false);

const totalMarketValue = computed(() => {
    return props.items.data.reduce((acc, item) => acc + item.dividend.price * item.quantity, 0);
});

const frequency = (value: string) => {
    const options: Record<string, number> = {
        annually: 1,
        semiannual: 2,
        quarterly: 4,
        monthly: 12,
    };
    return options[value] ?? 1;
};

const handleSelection = (event: any) => {
    dividend.value = props.results.data.find((item) => item.symbol === event);
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
                            :items="results.data"
                            item-label="name"
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
                                        <Typography variant="caption">{{ item.name }}</Typography>
                                    </div>
                                </div>
                            </template>
                        </FormAutocomplete>
                    </BudgetForm>
                </div>
            </div>

            <Tabs>
                <TabItem title="Holdings">
                    <Table :items="items.data">
                        <ColumnBasic :colspan="3" header="Name">
                            <template v-slot:default="{ data }">
                                <div class="flex items-center space-x-2">
                                    <img :src="data.dividend.image" alt="" class="h-12 w-12" />
                                    <div>
                                        <Typography variant="body1">
                                            {{ data.dividend.name }}
                                        </Typography>
                                        <Typography variant="caption">
                                            {{ data.dividend.symbol }}
                                        </Typography>
                                    </div>
                                </div>
                            </template>
                        </ColumnBasic>
                        <ColumnBasic :colspan="1" header="Price">
                            <template v-slot:default="{ data }">
                                {{ convertToCurrency(data.dividend.price) }}
                            </template>
                        </ColumnBasic>
                        <ColumnBasic :colspan="1" header="% of Portfolio">
                            <template v-slot:default="{ data }">
                                {{
                                    convertToPercentage(
                                        (data.dividend.price * data.quantity) / totalMarketValue,
                                        true,
                                    )
                                }}
                            </template>
                        </ColumnBasic>
                        <ColumnBasic :colspan="1" header="Shares">
                            <template v-slot:default="{ data }">
                                {{ data.quantity }}
                            </template>
                        </ColumnBasic>
                        <ColumnBasic header="Yield">
                            <template v-slot:default="{ data }">
                                {{ convertToPercentage(data.dividend.yield) }}
                            </template>
                        </ColumnBasic>
                        <ColumnBasic :colspan="2" header="Market Value">
                            <template v-slot:default="{ data }">
                                {{ convertToCurrency(data.dividend.price * data.quantity) }}
                            </template>
                        </ColumnBasic>
                        <ColumnBasic :colspan="1" header="Annual Income">
                            <template v-slot:default="{ data }">
                                {{
                                    convertToCurrency(
                                        data.dividend.payout_amount *
                                            frequency(data.dividend.frequency) *
                                            data.quantity,
                                    )
                                }}
                            </template>
                        </ColumnBasic>
                        <ColumnBasic :colspan="1" header="">
                            <template v-slot:default="{ data }">
                                <div class="flex justify-end">
                                    <FormButton :icon="Settings" fab @click=""></FormButton>
                                </div>
                            </template>
                        </ColumnBasic>
                    </Table>
                </TabItem>
                <TabItem title="Payouts">Payouts</TabItem>
            </Tabs>
        </AuthenticatedContentLayout>
    </AuthenticatedLayout>
</template>
