<script setup>
import { ref, onMounted, computed } from "vue";
import { useDisplay } from "vuetify";

import MainLayout from "@/Layouts/MainLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";

import ProductCard from "@/Components/ProductCard.vue";

const props = defineProps(["products"]);

const cols = computed(() => {
  const { name } = useDisplay();
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
        <v-col
          v-for="(product, index) in products"
          :key="product.id"
          :cols="cols"
          class="px-1"
        >
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
