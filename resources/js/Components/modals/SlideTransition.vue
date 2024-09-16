<script setup lang="ts">
import { computed, onBeforeUnmount, onMounted, ref, watch } from 'vue';

type Props = {
    delay?: number;
    direction: 'left' | 'up';
    show: boolean;
};

const props = withDefaults(defineProps<Props>(), { delay: 0.15 });

let timeoutId: undefined | NodeJS.Timeout;
const elem = ref<HTMLDivElement | null>(null);

const opposite_direction = computed(() => {
    switch (props.direction) {
        case 'left':
            return 'right';
        case 'up':
            return 'down';
    }
});

const updateClass = () => {
    if (props.show) {
        elem?.value?.classList.remove('out');
        elem?.value?.classList.add(props.direction);
    } else {
        elem?.value?.classList.remove(props.direction);
        elem?.value?.classList.add(opposite_direction.value);
        timeoutId = setTimeout(() => {
            elem?.value?.classList.add('out');
            elem?.value?.classList.remove(opposite_direction.value);
        }, props.delay * 1000);
    }
};

onMounted(() => {
    updateClass();
});

watch(() => props.show, updateClass);

onBeforeUnmount(() => {
    if (timeoutId) {
        clearTimeout(timeoutId);
    }
});
</script>

<template>
    <div class="animated animated-slide out" ref="elem">
        <slot />
    </div>
</template>

<style scoped>
.out {
    transform: translate3d(100%, 0, 0);
}

.animated {
    -webkit-animation-fill-mode: none, forwards;
    animation-fill-mode: none, forwards;
    animation-iteration-count: 1;
}

.animated-slide {
    -webkit-animation-duration: 0.2s;
    animation-duration: 0.2s;
}

@keyframes slide_right {
    from {
        -webkit-transform: translate3d(0, 0, 0);
        transform: translate3d(0, 0, 0);
    }

    to {
        -webkit-transform: translate3d(100%, 0, 0);
        transform: translate3d(100%, 0, 0);
    }
}

@keyframes slide_left {
    from {
        -webkit-transform: translate3d(100%, 0, 0);
        transform: translate3d(100%, 0, 0);
    }

    to {
        -webkit-transform: translate3d(0, 0, 0);
        transform: translate3d(0, 0, 0);
    }
}

@keyframes slide_up {
    from {
        -webkit-transform: translate3d(0, 100%, 0);
        transform: translate3d(0, 100%, 0);
    }

    to {
        -webkit-transform: translate3d(0, 0, 0);
        transform: translate3d(0, 0, 0);
    }
}

@keyframes slide_down {
    from {
        -webkit-transform: translate3d(0, 0, 0);
        transform: translate3d(0, 0, 0);
    }

    to {
        -webkit-transform: translate3d(0, 100%, 0);
        transform: translate3d(0, 100%, 0);
    }
}

.left {
    animation-name: slide_left;
}

.down {
    animation-name: slide_down;
}

.right {
    animation-name: slide_right;
}

.up {
    animation-name: slide_up;
}
</style>
