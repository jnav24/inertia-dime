<script setup lang="ts">
import Table from '@/Components/table/Table.vue';
import { UserDividendTransaction } from '@/types/dividends';
import ColumnBadge from '@/Components/table/ColumnBadge.vue';
import { ColumnBadgeColor } from '@/types/table';
import { TransactionEnum } from '@/types/dividends';
import Typography from '@/Components/Elements/Typography.vue';
import ColumnBasic from '@/Components/table/ColumnBasic.vue';
import { convertToCurrency } from '@/utils/functions';
import { formatTimeZone } from '@/utils/timestamp';

const props = defineProps<{ transactions: UserDividendTransaction[] }>();

const transactionColor = (item: Record<string, any>) => {
    const options = {
        [TransactionEnum.BUY]: ColumnBadgeColor.SUCCESS,
        [TransactionEnum.SELL]: ColumnBadgeColor.DANGER,
        [TransactionEnum.REINVEST]: ColumnBadgeColor.WARNING,
    };

    return (
        options[(item.value as UserDividendTransaction).transaction_type] ?? ColumnBadgeColor.GRAY
    );
};
</script>

<template>
    <Table :items="transactions">
        <ColumnBadge
            :color="transactionColor"
            header="Type"
            notation="transaction_type"
            capitalize
        />

        <ColumnBasic :colspan="3" header="Name">
            <template v-slot:default="{ data }">
                <div class="flex items-center space-x-2">
                    <img :src="data.user_dividend.dividend.image" alt="" class="h-12 w-12" />
                    <div>
                        <Typography variant="body1">
                            {{ data.user_dividend.dividend.name }}
                        </Typography>
                        <Typography variant="caption">
                            {{ data.user_dividend.dividend.symbol }}
                        </Typography>
                    </div>
                </div>
            </template>
        </ColumnBasic>

        <ColumnBasic :colspan="1" header="Shares">
            <template v-slot:default="{ data }">
                {{ data.quantity.toFixed(2) }}
            </template>
        </ColumnBasic>

        <ColumnBasic :colspan="1" header="Price">
            <template v-slot:default="{ data }">
                {{ convertToCurrency(data.price) }}
            </template>
        </ColumnBasic>

        <ColumnBasic :colspan="1" header="Date">
            <template v-slot:default="{ data }">
                {{ formatTimeZone('yyyy-MM-dd', 'UTC', data.transaction_date) }}
            </template>
        </ColumnBasic>
    </Table>
</template>
