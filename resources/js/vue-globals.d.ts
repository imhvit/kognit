export {}

declare module 'vue' {
    interface ComponentCustomProperties {
        $can: (permission: string | string[]) => boolean;
        $role: (role: string | string[]) => boolean;
    }
}