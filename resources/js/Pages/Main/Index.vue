<script setup>
import { ref, onMounted, computed } from "vue";
import { useDisplay } from "vuetify";

import MainLayout from "@/Layouts/MainLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";

import ProductCard from "@/Components/ProductCard.vue";

const props = defineProps(["products"]);
let showModal = ref(false);

const display = useDisplay();

console.log(display);

const cols = computed(() => {
  const { lg, sm } = useDisplay();
  return lg ? 3 : sm ? 4 : 6;
});
</script>
<template>
  <Head title="Main" />

  <MainLayout>
    <div class="p-4 max-w-7xl mx-auto flex flex-col items-center">
      <v-container>
        <v-row>
          <v-col
            v-for="(product, index) in products"
            :key="product.id"
            :cols="cols"
          >
            <ProductCard :product="product"></ProductCard>
          </v-col>
        </v-row>
      </v-container>
    </div>
  </MainLayout>
</template>

<style scoped></style>
