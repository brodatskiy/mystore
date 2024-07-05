/**
 * plugins/index.ts
 *
 */

import PrimeVue from "primevue/config";
import ToastService from "primevue/toastservice";
import Aura from '@primevue/themes/aura';

// Plugins
import { createPinia } from "pinia";

const pinia = createPinia();

export function registerPlugins(app) {
    app.use(PrimeVue, {
        theme: {
            preset: Aura
        }
    })
        .use(ToastService)
        .use(pinia);
}
