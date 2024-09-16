<script setup lang="ts">
import { onBeforeUnmount, onMounted, ref, watch } from 'vue';

type Props = {
    delay?: number;
    show: boolean;
};

const props = withDefaults(defineProps<Props>(), { delay: 0.15 });

const elem = ref<HTMLDivElement | null>(null);
let timeoutId: NodeJS.Timeout | undefined = undefined;

const updateClass = () => {
    if (props.show) {
        elem.value?.classList.remove('dn');
        elem.value?.classList.add('fadeIn');
    } else {
        elem.value?.classList.remove('fadeIn');
        elem.value?.classList.add('fadeOut');
        timeoutId = setTimeout(() => {
            elem.value?.classList.add('dn');
            elem.value?.classList.remove('fadeOut');
        }, props.delay * 1000);
    }
};

onMounted(() => {
    updateClass();
});

watch(() => props.show, updateClass);
watch(() => props.delay, updateClass);

onBeforeUnmount(() => {
    if (timeoutId) {
        clearTimeout(timeoutId);
    }
});
</script>

<template>
    <div class="animated animated-fade dn fixed inset-0 z-100 overflow-hidden" ref="elem">
        <slot />
    </div>
</template>

<style scoped>
.dn {
    display: none;
}

.animated {
    -webkit-animation-fill-mode: none, forwards;
    animation-fill-mode: none, forwards;
    animation-iteration-count: 1;
}

.animated-fade {
    -webkit-animation-duration: 0.3s;
    animation-duration: 0.3s;
}

.fadeIn {
    animation-name: fadeIn;
    opacity: 1;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }

    to {
        opacity: 1;
    }
}

.fadeOut {
    animation-name: fadeOut;
    opacity: 0;
}

@keyframes fadeOut {
    from {
        opacity: 1;
    }

    to {
        opacity: 0;
    }
}
</style>
