/**
 * plugins/index.ts
 *
 */

import PrimeVue from "primevue/config";
import ToastService from "primevue/toastservice";
import Lara from "~/presets/Lara";

// Plugins
import { createPinia } from "pinia";

const pinia = createPinia();

export function registerPlugins(app) {
    app.use(PrimeVue, { unstyled: true, pt: Lara })
        .use(ToastService)
        .use(pinia);
}
