<script setup>
import { ref, onMounted, computed } from "vue";
import { useDisplay } from "vuetify";

import ShopLayout from "@/Layouts/ShopLayout.vue";
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
  <Head title="Catalog" />

  <ShopLayout>
    <v-container class="pa-0">
      <v-row>
        <v-col v-for="product in products" :key="product.id" :cols="cols">
          <ProductCard :product="product"></ProductCard>
        </v-col>
      </v-row>
    </v-container>
  </ShopLayout>
</template>
