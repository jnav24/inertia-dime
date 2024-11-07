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

type ColumnProps = ColumnBasicProps | ColumnBadgeProps;

export type ColumnComponent<T> = DefineComponent<ColumnProps | T, {}, any>;

export type Column<T> = {
    content:
        | string
        | {
              props: ColumnProps | ((obj: T) => ColumnProps | T);
              component: ColumnComponent<T>;
          };
    label: string;
    searchable?: boolean;
    colspan?: number;
    sortable?: boolean;
};
