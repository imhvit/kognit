import { createInertiaApp, usePage } from "@inertiajs/vue3";
import createServer from "@inertiajs/vue3/server";
import { createSSRApp, h } from "vue";
import { renderToString } from "vue/server-renderer";
import { ZiggyVue } from "ziggy-js";
import AppLayout from "@/layouts/AppLayout.vue";
import AuthLayout from "@/layouts/AuthLayout.vue";

const appName = import.meta.env.VITE_APP_NAME || "Kognit";

createServer((page) =>
    createInertiaApp({
        title: (title) => (title ? `${title} - Kognit` : appName),
        page,
        render: renderToString,
        resolve: (name) => {
            const pages = import.meta.glob("./pages/**/*.vue", { eager: true });
            return pages[`./pages/${name}.vue`].default;
        },
        setup({ App, props, plugin }) {
            const app = createSSRApp({
                render: () => h(App, props),
            });

            app.use(plugin).use(ZiggyVue, {
                ...props.initialPage.props.ziggy,
                location: new URL(props.initialPage.props.ziggy.location),
            });

            app.config.globalProperties.$can = (permission) => {
                const userPermissions = usePage().props.auth.permissions || [];
                return Array.isArray(permission)
                    ? permission.some((p) => userPermissions.includes(p))
                    : userPermissions.includes(permission);
            };

            app.config.globalProperties.$role = (role) => {
                const userRoles = usePage().props.auth.roles || [];
                return Array.isArray(role)
                    ? role.some((r) => userRoles.includes(r))
                    : userRoles.includes(role);
            };

            return app;
        },
    }),
);
