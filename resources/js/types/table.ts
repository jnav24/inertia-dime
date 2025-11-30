import type { ComputedRef, Ref } from 'vue';
import { Optional } from '@/types/index';

export const TableContext = Symbol('TableContext');
export const TableRowContext = Symbol('TableRowContext');

export interface TableColumn {
    colspan: number;
    label: string;
    sortable?: boolean;
    width: string;
}

export interface ColumnProps {
    header: string;
    colspan?: number;
    notation?: string;
    searchable?: boolean;
}

export enum ColumnBadgeColor {
    DANGER = 'danger',
    GRAY = 'gray',
    INFO = 'info',
    PRIMARY = 'primary',
    SUCCESS = 'success',
    WARNING = 'warning',
}

export interface TableContextType {
    allChecked: Ref<boolean>;
    checkedItems: Ref<(string | number)[]>;
    data: ComputedRef<any[]>;
    getColSpan: (cols: number) => string;
    getHeaders: ComputedRef<readonly TableColumn[]>;
    getGutter: ComputedRef<string>;
    hasSearchableItems: ComputedRef<boolean>;
    resetHeaders: () => void;
    searchKey: Ref<string>;
    selectable: boolean;
    setAllChecked: (v: boolean) => void;
    setHeaders: (header: Record<string, any>) => void;
    setSearchable: (value: string) => void;
    toggleCheckedItem: (checked: boolean, id: number | string) => void;
    updatePage: (page: number) => void;
    updateSelectedPaginatePerPage: (page: number) => void;
}

export interface TableRowContextType {
    data: any;
    getContent: (header: string, notation?: string | undefined) => string;
    parseValue: (value: string) => string;
}
