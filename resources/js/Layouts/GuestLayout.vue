<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <v-app>
        <v-sheet color="surface" class="h-100 d-flex align-center">
            <v-card
                class="d-flex flex-column align-center w-25 px-6 py-4 mx-auto bg-white"
                rounded="xl"
                max-width="448"
            >
                <div>
                    <Link :href="route('/')" class="d-flex align-baseline">
                        <v-icon icon="mdi-store" size="large" class=""></v-icon>
                        <h1 class="font-weight-bold">MyStore</h1>
                    </Link>
                </div>

                <div class="w-75 mt-2">
                    <slot />
                </div>
            </v-card>
        </v-sheet>
    </v-app>
</template>

<style></style>
