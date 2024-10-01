export const NotificationContext = Symbol('FormContext');

export type NotificationContextType = {
    addNotification: (notify: NotificationProps) => void;
};

export type NotificationProps = {
    title: string;
    message: string;
    type: 'success' | 'warn' | 'error' | 'info';
};
