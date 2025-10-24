import { usePage } from '@inertiajs/vue3';
import { PageProps } from '@/types/providers';
import { computed, onMounted, reactive, ref, toRefs, watch, watchEffect } from 'vue';

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
    const { ziggy } = usePage().props as unknown as PageProps;

    const state = reactive<FetchResponse>({
        data: {},
        errors: [] as string[],
        isError: false,
        isFetching: false,
        isLoading: false,
        isSuccess: false,
    });

    const urlParams = ref({});

    const hasData = computed(() => state.data && Object.keys(state.data).length);

    const trimSlashes = (str: string) => {
        if (str.startsWith('/')) {
            str = str.slice(1, str.length);
        }

        if (str.endsWith('/')) {
            str = str.slice(0, -1);
        }

        return str;
    };

    const getURL = () => {
        const url = `${ziggy.url}/${trimSlashes(path)}`;

        if (method === 'get') {
            return `${url}?${new URLSearchParams(urlParams.value)}`;
        }

        return url;
    };

    const getOptions = (): RequestInit => {
        const csrf = document?.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const options: RequestInit = {
            method,
            credentials: 'include',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf ?? '',
                ...headers,
            },
        };

        if (method !== 'get') {
            return { ...options, body: JSON.stringify(urlParams.value) };
        }

        return options;
    };

    const getResponse = async () => {
        try {
            state.isLoading = true;

            const response = await fetch(getURL(), getOptions());

            state.isError = !response.ok;
            state.isSuccess = response.ok;
            state.data = await response.json();
        } catch (err: unknown) {
            let errors = ['Something unexpected had occurred'];

            if (err instanceof Error) {
                errors = [err.message];
            }

            state.isError = true;
            state.isSuccess = false;
            state.errors = errors;
        } finally {
            state.isFetching = false;
            state.isLoading = false;
        }
    };

    const refetch = (params?: Record<string, any>) => {
        if (state.isFetching) return null;

        if (params) {
            urlParams.value = params;
        }

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
        { immediate: true },
    );

    watchEffect(() => {
        if (state.isFetching) {
            void getResponse();
        }
    });

    onMounted(() => {
        urlParams.value = params;
    });

    return { ...toRefs(state), refetch, reset };
}
