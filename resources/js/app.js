import "@fontsource-variable/inter/wght.css";
import { createInertiaApp, usePage } from "@inertiajs/vue3";
import { ZiggyVue } from "ziggy-js";
import AppLayout from "@/layouts/AppLayout.vue";
import AuthLayout from "@/layouts/AuthLayout.vue";
import { createSSRApp, h } from "vue";

const appName = import.meta.env.VITE_APP_NAME || "Kognit";

createInertiaApp({
    title: (title) => (title ? `${title} - Kognit` : appName),
    resolve: (name) => {
        const pages = import.meta.glob("./pages/**/*.vue", { eager: true });
        let page = pages[`./pages/${name}.vue`].default;

        const layout = page.layout;

        if (layout === undefined) {
            if (name === "Welcome") {
                page.layout = null;
            } else if (name.startsWith("auth/")) {
                page.layout = AuthLayout;
            } else {
                page.layout = AppLayout;
            }
        }

        return page;
    },
    setup({ el, App, props, plugin }) {
        const app = createSSRApp({ render: () => h(App, props) });
        app.use(plugin);
        app.use(ZiggyVue);

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
        app.mount(el);
    },
    progress: {
        color: "#5850ec",
        showSpinner: false,
    },
});
