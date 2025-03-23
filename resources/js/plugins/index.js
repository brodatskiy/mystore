import PrimeVue from 'primevue/config';
import ToastService from "primevue/toastservice";
import {definePreset} from '@primeuix/themes';
import {createPinia} from "pinia";
import Aura from '@primeuix/themes/aura';

const pinia = createPinia();

const Noir = definePreset(Aura, {
    semantic: {
        primary: {
            50: '{rose.50}',
            100: '{rose.100}',
            200: '{rose.200}',
            300: '{rose.300}',
            400: '{rose.400}',
            500: '{rose.500}',
            600: '{rose.600}',
            700: '{rose.700}',
            800: '{rose.800}',
            900: '{rose.900}',
            950: '{rose.950}'
        },
        colorScheme: {
            light: {
                primary: {
                    color: '{neutral.950}',
                    inverseColor: '{neutral.50}',
                    hoverColor: '{neutral.900}',
                    activeColor: '{neutral.800}'
                },
                highlight: {
                    background: '{neutral.950}',
                    focusBackground: '{neutral.700}',
                    color: '#ffffff',
                    focusColor: '#ffffff'
                },
                surface: {
                    50: '{neutral.50}',
                    100: '{neutral.100}',
                    200: '{neutral.200}',
                    300: '{neutral.300}',
                    400: '{neutral.400}',
                    500: '{neutral.500}',
                    600: '{neutral.600}',
                    700: '{neutral.700}',
                    800: '{neutral.800}',
                    900: '{neutral.900}',
                    950: '{neutral.950}'
                },
            },
            dark: {
                primary: {
                    color: '{zinc.100}',
                    inverseColor: '{zinc.950}',
                    hoverColor: '{zinc.200}',
                    activeColor: '{zinc.300}'
                },
                highlight: {
                    background: '{zinc.950}',
                    focusBackground: '{zinc.700}',
                    color: '#ffffff',
                    focusColor: '#ffffff'
                },
                formField: {
                    background: '{zinc.700}',
                    color: '{zinc.100}',
                    placeholderColor: '{zinc.400}',
                    borderColor: '{zinc.500}',
                    hoverBorderColor: '{zinc.400}',
                    focusBorderColor: '{zinc.300}',
                },
                overlay: {
                    modal: {
                        background: '{zinc.800}',
                    },
                },
                surface: {
                    50: '{zinc.50}',
                    100: '{zinc.100}',
                    200: '{zinc.200}',
                    300: '{zinc.300}',
                    400: '{zinc.400}',
                    500: '{zinc.500}',
                    600: '{zinc.600}',
                    700: '{zinc.700}',
                    800: '{zinc.800}',
                    900: '{zinc.900}',
                    950: '{zinc.950}'
                },
            }
        }
    }
});

export function registerPlugins(app) {
    app.use(PrimeVue, {
        theme: {
            preset: Noir,
            options: {
                darkModeSelector: '.dark',
                cssLayer: false
            }
        }
    })
        .use(ToastService)
        .use(pinia);
}
