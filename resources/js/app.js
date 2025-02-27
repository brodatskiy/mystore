import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";
import { Icon } from "@iconify/vue";

import { createI18n } from "vue-i18n";
import ru from "../../lang/ru.json";
import en from "../../lang/en.json";

// Plugins

import { registerPlugins } from "@/plugins";

const appName = import.meta.env.VITE_APP_NAME || "MyStore";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        const i18n = createI18n({
            legacy: false,
            locale: props.initialPage.props.locale, // user locale by props
            fallbackLocale: "en", // set fallback locale
            messages: { ru, en },
        });

        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(i18n)
            .component("Icon", Icon)
            .use(registerPlugins)
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});
