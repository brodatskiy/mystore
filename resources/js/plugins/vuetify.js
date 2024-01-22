// Styles
import "@mdi/font/css/materialdesignicons.css";
import "vuetify/styles"; // Global CSS has to be imported

import { createVuetify } from "vuetify";

const myCustomLightTheme = {
  colors: {
    background: "#FFFFFF",
    backgroundAdmin: "#FFFFFF",
    surface: "#111111",
    surface_light: "#a3a3a3",
    surfaceAdmin: "#F0E0D6",
    primary: "#111111",
    secondary: "#03DAC6",
    error: "#f04d3e",
    info: "#2196F3",
    success: "#4CAF50",
    warning: "#FB8C00",
  },
};

export default createVuetify({
  theme: {
    defaultTheme: "myCustomLightTheme",
    themes: {
      myCustomLightTheme,
    },
  },
  defaults: {
    global: {
      ripple: false,
    },
  },
});
