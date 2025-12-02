<script setup lang="ts">
import VerticalEllipsis from '@/Components/Icons/solid/VerticalEllipsis.vue';
import Dropdown from '@/Components/Dropdown.vue';
import { computed, inject } from 'vue';
import { TableContext, type TableContextType } from '@/types/table';
import FormInput from '@/Components/Fields/FormInput.vue';
import MagnifyingGlass from '@/Components/Icons/outline/MagnifyingGlass.vue';
import BudgetForm from '@/Components/Fields/BudgetForm.vue';

const tableContext = inject<TableContextType>(TableContext);

const showOptions = computed(() => {
    return tableContext?.hasSearchableItems?.value || tableContext?.selectable;
});

const updateSearch = (value: string | undefined) => {
    if (tableContext?.searchKey) {
        tableContext.searchKey.value = value ?? '';
        tableContext.updatePage(1);
    }
};
</script>

<template>
    <div v-if="showOptions" class="flex flex-row items-center justify-between p-4">
        <div>
            <template v-if="tableContext?.hasSearchableItems?.value">
                <BudgetForm>
                    <FormInput
                        @update:value="updateSearch"
                        :icon="MagnifyingGlass"
                        :value="tableContext?.searchKey.value ?? ''"
                        label="Search"
                        placeholder
                    />
                </BudgetForm>
            </template>
        </div>

        <div>
            <template v-if="tableContext?.selectable">
                <Dropdown>
                    <template #trigger>
                        <VerticalEllipsis classes="size-4" />
                    </template>

                    <template #menu>
                        <p>Sentry</p>
                    </template>
                    <!-- Dropdown; props - disabled, items -->
                    <!-- item; label, icon, action -->
                </Dropdown>
            </template>
        </div>
    </div>
</template>
