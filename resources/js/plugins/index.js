import PrimeVue from 'primevue/config';
import ToastService from "primevue/toastservice";
import {definePreset} from '@primeuix/themes';
import {createPinia} from "pinia";
import Aura from '@primeuix/themes/aura';

const pinia = createPinia();

const Noir = definePreset(Aura, {
    semantic: {
        primary: {
            50: '{purple.50}',
            100: '{purple.100}',
            200: '{purple.200}',
            300: '{purple.300}',
            400: '{purple.400}',
            500: '{purple.500}',
            600: '{purple.600}',
            700: '{purple.700}',
            800: '{purple.800}',
            900: '{purple.900}',
            950: '{purple.950}'
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
                    color: '{primary.500}',
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
                    color: '{primary.300}',
                },
                formField: {
                    background: '{surface.700}',
                    color: '{primary.300}',
                },
                overlay: {
                    modal: {
                        background: '{surface.700}',
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
