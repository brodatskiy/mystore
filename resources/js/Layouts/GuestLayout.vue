<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
  <v-app>
    <v-sheet color="background" class="h-100 d-flex align-center">
      <v-card
        class="d-flex flex-column align-center w-25 px-6 py-6 mx-auto"
        color="surface"
        rounded="xl"
        width="450"
        min-width="350"
      >
        <div class="">
          <Link :href="route('/')" class="d-flex align-baseline">
            <v-icon icon="mdi-store" size="large" class=""></v-icon>
            <h1 class="font-weight-bold">MyStore</h1>
          </Link>
        </div>

        <div class="w-75 mt-5">
          <slot />
        </div>
      </v-card>
    </v-sheet>
  </v-app>
</template>

<style></style>
