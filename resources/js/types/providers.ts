export const NotificationContext = Symbol('FormContext');

export type NotificationContextType = {
    addNotification: (notify: NotificationProps) => void;
};

export type NotificationProps = {
    title: string;
    message: string;
    type: 'success' | 'warn' | 'error' | 'info';
};

export type PageProps = {
    auth: { id: number; name: string; email: string; email_verified_at: string };
    errors: Record<string, string>;
    flash: { message: string | null };
    ziggy: {
        url: string;
        defaults: any[];
        location: string;
        port: number;
        routes: Record<string, { methods: string[]; uri: string }>;
    };
};
