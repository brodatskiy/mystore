import { fileURLToPath, URL } from "url";

import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import svgLoader from "vite-svg-loader";

import vuetify from "vite-plugin-vuetify";

export default defineConfig({
  plugins: [
    laravel({
      input: "resources/js/app.js",
      refresh: true,
    }),
    vue({
      template: {
        transformAssetUrls: {
          base: null,
          includeAbsolute: true,
        },
      },
    }),
    svgLoader(),
  ],
  resolve: {
    alias: {
      "~": fileURLToPath(new URL("./resources", import.meta.url)),
    },
  },
  server: {
    host: "0.0.0.0",
    hmr: {
      host: "localhost",
    },
  },
});
