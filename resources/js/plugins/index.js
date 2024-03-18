/**
 * plugins/index.ts
 *
 */

import PrimeVue from "primevue/config";
import Lara from "~/presets/Lara";

// Plugins
// import vuetify from "./vuetify";
// import pinia from '../store'
// import router from '../router'

export function registerPlugins(app) {
  app.use(PrimeVue, { unstyled: true, pt: Lara });
  // app.use(vuetify);
}
