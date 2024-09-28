<script setup lang="ts">
import Notification from '@/Components/Elements/Notification.vue';
import { provide, ref, watchEffect } from 'vue';
import type { NotificationProps, NotificationContextType } from '@/types/providers';
import { NotificationContext } from '@/types/providers';

const DURATION = 5000;

const interval = ref<null | ReturnType<typeof setInterval>>(null);
const notifications = ref<Array<NotificationProps & { timestamp: number }>>([]);

const addNotification = (notify: NotificationProps) => {
    notifications.value = [...notifications.value, { ...notify, timestamp: new Date().getTime() }];
};

watchEffect((onCleanup) => {
    if (notifications.value.length) {
        clearInterval(interval.value);

        interval.value = setInterval(() => {
            notifications.value = notifications.value.filter(
                (notify) => new Date().getTime() - notify.timestamp < DURATION,
            );
        }, 1000);

        onCleanup(() => {
            clearInterval(interval.value);
        });
    } else {
        clearInterval(interval.value);
        interval.value = null;
    }
});

provide<NotificationContextType>(NotificationContext, { addNotification });
</script>

<template>
    <slot />

    <div class="absolute bottom-0 right-0 p-4">
        <template v-for="(notification, idx) in notifications" :key="idx">
            <Notification v-bind="notification" />
        </template>
    </div>
</template>
