// Styles
import "@mdi/font/css/materialdesignicons.css";
import "vuetify/styles"; // Global CSS has to be imported

import { createVuetify } from "vuetify";

const myCustomLightTheme = {
  colors: {
    background: "#EEEEEE",
    backgroundAdmin: "#FFFFFF",
    surface: "#FFFFFF",
    primary: "#111111",
    secondary: "#5b79f0",
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
