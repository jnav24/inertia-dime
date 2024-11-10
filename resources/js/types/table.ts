import { DefineComponent } from 'vue';
import { Aggregation } from '@/types/budget';

export type ColumnBasicProps = { value: string };

export type ColumnBadgeProps = ColumnBasicProps & {
    color: 'success' | 'danger' | 'default';
};

export type ColumnTrendProps = {
    aggregation: Aggregation;
    highestSaved: number;
};

type ColumnProps = ColumnBasicProps | ColumnBadgeProps | ColumnTrendProps;

export type ColumnComponent<T> = DefineComponent<ColumnProps | T, {}, any>;

export type ColumnComponentObject<T> = {
    props: (obj: T) => ColumnProps | { obj: T };
    component: ColumnComponent<T>;
};

export type Column<T> = {
    content: string | ColumnComponentObject<T>;
    label: string;
    searchable?: boolean;
    colspan?: number;
    sortable?: boolean;
};
