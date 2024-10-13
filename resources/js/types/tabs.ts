import { ComputedRef } from 'vue';

export type TabContextType = {
    activeTab: ComputedRef<string>;
    addTab: (tab: string) => void;
};

export const TabContext = Symbol('TabContext');
