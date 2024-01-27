<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
  <v-app>
    <v-sheet color="background" class="ma-auto">
      <ApplicationLogo />

      <v-card
        class="d-flex flex-column align-center pa-5 ma-5"
        color="surface"
        rounded="xl"
        min-width="400"
        max-width="700"
      >
        <div class="w-75 mt-5">
          <slot />
        </div>
      </v-card>
    </v-sheet>
  </v-app>
</template>

<style></style>
