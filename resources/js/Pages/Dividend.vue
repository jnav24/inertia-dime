<script lang="ts" setup>
import { computed, ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AuthenticatedContentLayout from '@/Layouts/AuthenticatedContentLayout.vue';
import Holdings from '@/Components/Dividends/Holdings.vue';
import Tabs from '@/Components/tabs/Tabs.vue';
import TabItem from '@/Components/tabs/TabItem.vue';
import FormAutocomplete from '@/Components/Fields/FormAutocomplete.vue';
import DividendSearchModal from '@/Components/modals/DividendSearchModal.vue';
import MagnifyingGlass from '@/Components/Icons/outline/MagnifyingGlass.vue';
import BudgetForm from '@/Components/Fields/BudgetForm.vue';
import { PageProps } from '@/types/providers';
import Typography from '@/Components/Elements/Typography.vue';
import { convertToCurrency, convertToPercentage } from '@/utils/functions';
import useDividends from '@/Composables/useDividends';
import { UserDividend, UserDividendSearch, UserDividendTransaction } from '@/types/dividends';
import Transactions from '@/Components/Dividends/Transactions.vue';

type Props = PageProps & {
    items: { data: UserDividend[] };
    results: { data: UserDividendSearch[] };
    transactions: { data: UserDividendTransaction[] };
};

const props = defineProps<Props>();

const { frequency, totalMarketValue } = useDividends({ items: props.items.data });

const dividend = ref({});
const showModal = ref(false);

const autocompleteOptions = computed(() => props.results.data.map((item) => item.dividend));

const handleDividendSelection = (selected: any) => {
    dividend.value = {
        ...selected,
        income: convertToCurrency(
            selected.dividend.payout_amount *
                frequency(selected.dividend.frequency) *
                selected.quantity,
        ),
        percentage: convertToPercentage(
            (selected.dividend.price * selected.quantity) / totalMarketValue.value,
            true,
        ),
    };
    showModal.value = true;
};

const handleSearchSelection = (event: any) => {
    const selected = props.results.data.find((item) => item.dividend.symbol === event);
    handleDividendSelection(selected);
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
                :errors="errors"
                :notify="flash.message ?? ''"
                :show="showModal"
            />

            <div class="flex justify-end">
                <div class="w-1/3">
                    <BudgetForm :action="route('dividends.search')">
                        <FormAutocomplete
                            @handle-selection="handleSearchSelection"
                            :icon="MagnifyingGlass"
                            :items="autocompleteOptions as unknown as Record<string, string>[]"
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
                    <Holdings @handle-selection="handleDividendSelection" :items="items.data" />
                </TabItem>
                <TabItem title="Payouts">
                    <pre>notes for payouts tab</pre>
                    <pre>
If the declaration date and payout date already passed, then the payout amount for the next divided is estimated</pre
                    >
                </TabItem>
                <TabItem title="Transactions">
                    <Transactions :transactions="transactions.data" />
                </TabItem>
            </Tabs>
        </AuthenticatedContentLayout>
    </AuthenticatedLayout>
</template>
