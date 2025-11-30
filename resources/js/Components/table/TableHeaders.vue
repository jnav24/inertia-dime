<script setup lang="ts">
import { inject } from 'vue';
import { TableContext, type TableContextType } from '@/types/table';
import Typography from '@/Components/Elements/Typography.vue';
import FormCheckbox from '@/Components/Fields/FormCheckbox.vue';

const tableContext = inject<TableContextType>(TableContext);
</script>

<template>
    <div
        class="flex flex-row items-center justify-between space-x-4 border-b border-lm-stroke px-4 py-4 text-lm-text-hover dark:border-dm-stroke dark:text-dm-text-hover"
    >
        <FormCheckbox
            v-if="tableContext?.selectable"
            :is-checked="tableContext?.allChecked.value"
            @handleUpdate="tableContext.setAllChecked($event)"
            label=""
        />
        <div class="flex grow flex-row items-center justify-between">
            <template v-for="(column, index) in tableContext?.getHeaders?.value ?? []" :key="index">
                <div :class="column.width" class="flex items-center space-x-2">
                    <Typography variant="caption">
                        <strong>{{ column.label }}</strong>
                    </Typography>
                    <button v-if="column?.sortable">^</button>
                </div>
            </template>
        </div>
    </div>
</template>
