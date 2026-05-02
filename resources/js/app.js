import "@fontsource-variable/inter/wght.css";
import { createInertiaApp } from "@inertiajs/vue3";
import AppLayout from "@/layouts/AppLayout.vue";
import AuthLayout from "@/layouts/AuthLayout.vue";

const appName = import.meta.env.VITE_APP_NAME || "Kognit";

createInertiaApp({
    title: (title) => (title ? `${title} - Kognit` : appName),
    layout: (name) => {
        switch (true) {
            case name === "Welcome":
                return null;
            case name.startsWith("auth/"):
                return AuthLayout;
            default:
                return [AppLayout];
        }
    },
    progress: {
        color: "#5850ec",
    },
});
