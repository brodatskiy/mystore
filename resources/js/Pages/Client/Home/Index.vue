<script setup>
import { ref, onMounted, computed } from "vue";
import { useDisplay } from "vuetify";

import MainLayout from "@/Layouts/MainLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

import ProductCard from "@/Components/ProductCard.vue";

const props = defineProps(["products"]);
const { name } = useDisplay();

const cols = computed(() => {
  switch (name.value) {
    case "md":
      return 4;
    case "lg":
      return 3;
    default:
      return 6;
  }

  return undefined;
});
</script>
<template>
  <Head title="Main" />

  <MainLayout>
    <v-container class="pa-0 grid-container">
      <v-row>
        <v-col v-for="product in products" :key="product.id" :cols="cols">
          <ProductCard :product="product"></ProductCard>
        </v-col>
      </v-row>
    </v-container>
  </MainLayout>
</template>

<style scoped>
.grid-container {
  grid-gap: 50px;
}
</style>
