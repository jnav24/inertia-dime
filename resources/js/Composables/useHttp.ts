import { usePage } from '@inertiajs/vue3';
import { PageProps } from '@/types/providers';
import { computed, reactive, watch } from 'vue';

/**
 * This does not really convert an object to an enum.
 * But it does transform the object in a way to
 * return proper typing in its usage
 *
 * This does not have intellisense or inference and will not throw an error
 * const URLMethods = { GET: 'get' };
 * const test: typeof URLMethods[keyof typeof URLMethods] = { methods: '' };
 *
 * This does have intellisense or inference and will throw an error
 * const URLMethods = mapToEnum({ GET: 'get' });
 * const test: typeof URLMethods[keyof typeof URLMethods] = { methods: '' };
 */
function mapToEnum<T extends { [index: string]: U }, U extends string>(x: T) {
    return x;
}

const URLMethods = mapToEnum({
    GET: 'get',
    POST: 'post',
    PUT: 'put',
    DELETE: 'delete',
});

type Props = {
    method: (typeof URLMethods)[keyof typeof URLMethods];
    path: string;
    params?: Record<string, any>;
    headers?: Record<string, any>;
    initialize?: boolean;
};

type FetchResponse = {
    errors: string[];
    isError: boolean;
    isFetching: boolean;
    isLoading: boolean;
    isSuccess: boolean;
    data: Record<string, any>;
};

export default function useHttp({
    method,
    path,
    params = {},
    headers = {},
    initialize = true,
}: Props) {
    const { ziggy } = usePage().props as PageProps;

    const state = reactive<FetchResponse>({
        data: {},
        errors: [] as string[],
        isError: false,
        isFetching: false,
        isLoading: false,
        isSuccess: false,
    });
    const hasData = computed(() => state.data && Object.keys(state.data).length);

    const getResponse = async () => {};

    const refetch = () => {
        if (state.isFetching) return null;
        state.isFetching = true;
        state.isLoading = !hasData.value;
    };

    const reset = () => {
        state.data = {};
        state.errors = [];
        state.isError = false;
        state.isFetching = false;
        state.isLoading = false;
        state.isSuccess = false;
    };

    watch(
        () => initialize,
        (init) => {
            if (init) {
                state.isFetching = true;
                state.isLoading = !hasData.value;
            }
        },
    );

    watch(
        () => state.isFetching,
        (isFetching) => {
            if (isFetching) {
                void getResponse();
            }
        },
    );

    return { ...state, refetch, reset };
}
