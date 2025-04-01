import PrimeVue from 'primevue/config';
import ToastService from "primevue/toastservice";
import {definePreset} from '@primeuix/themes';
import {createPinia} from "pinia";
import Aura from '@primeuix/themes/aura';

const pinia = createPinia();

const Noir = definePreset(Aura, {
    semantic: {
        primary: {
            50: '{violet.50}',
            100: '{violet.100}',
            200: '{violet.200}',
            300: '{violet.300}',
            400: '{violet.400}',
            500: '{violet.500}',
            600: '{violet.600}',
            700: '{violet.700}',
            800: '{violet.800}',
            900: '{violet.900}',
            950: '{violet.950}'
        },
        colorScheme: {
            light: {
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
                primary: {
                    color: '{primary.600}',
                    inverseColor: '{primary.500}',
                    hoverColor: '{primary.500}',
                    activeColor: '{primary.400}'
                },
                text: {
                    color: '{surface.950}',
                },
                formField: {
                    background: '{surface.300}',
                    color: '{primary.600}',
                },
            },
            dark: {
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
                primary: {
                    color: '{primary.300}',
                    inverseColor: '{zinc.350}',
                    hoverColor: '{primary.400}',
                    activeColor: '{primary.500}'
                },
                text: {
                    color: '{surface.50}',
                },
                formField: {
                    background: '{surface.700}',
                    color: '{primary.300}',
                },
                overlay: {
                    modal: {
                        background: '{surface.800}',
                    },
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
