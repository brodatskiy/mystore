<template>
  <Head title="Main" />

  <MainLayout>
    <v-carousel hide-delimiters cycle show-arrows="hover">
      <template v-slot:prev="{ props }">
        <button class="" @click="props.onClick">
          <v-icon icon="mdi-chevron-left" size="large" />
        </button>
      </template>
      <template v-slot:next="{ props }">
        <button class="" @click="props.onClick">
          <v-icon icon="mdi-chevron-right" size="large" />
        </button>
      </template>
      <v-carousel-item
        src="https://cdn.vuetifyjs.com/images/cards/docks.jpg"
        cover
      ></v-carousel-item>

      <v-carousel-item
        src="https://cdn.vuetifyjs.com/images/cards/hotel.jpg"
        cover
      ></v-carousel-item>

      <v-carousel-item
        src="https://cdn.vuetifyjs.com/images/cards/sunshine.jpg"
        cover
      ></v-carousel-item>
    </v-carousel>

    <div class="p-4 max-w-7xl mx-auto flex flex-col items-center">
      <!-- <div class="menu flex mb-2">
                <FilterProducts></FilterProducts>
            </div> -->

      <!-- <div
                v-if="!productStore.isLoading"
                class="grid gap-4 grid-cols-2 md:grid-cols-3 lg:grid-cols-5 mb-5"
            >
                <template
                    v-for="product in productStore.filtredAndSearchAndSortProducts"
                    :key="product.id"
                >
                    <ProductCard v-if="product.id" :product="product" />
                </template>


            </div> -->
      <div class="grid gap-4 grid-cols-2 md:grid-cols-3 lg:grid-cols-5 mb-5>">
        <ProductCard
          v-for="product in products"
          :key="product.id"
          :product="product"
        />
      </div>
      <div class="grid gap-4 grid-cols-2 md:grid-cols-3 lg:grid-cols-5 mb-5>">
        <ProductCard
          v-for="product in products"
          :key="product.id"
          :product="product"
        />
      </div>

      <!-- <div v-else class="mb-3"><p>Loading...</p></div> -->
    </div>
  </MainLayout>
</template>
<script setup>
import { ref, onMounted } from "vue";

// import { useProductStore } from "@/Store/useProductStore";
import MainLayout from "@/Layouts/MainLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";

import ModalWindow from "@/Components/ModalWindow.vue";
import CreateProduct from "@/Components/CreateProduct.vue";
import ProductCard from "@/Components/ProductCard.vue";
// import FilterProducts from "@/Components/FilterProducts.vue";

// const productStore = useProductStore();
const props = defineProps(["products"]);
let showModal = ref(false);

onMounted(() => {});
</script>

<style scoped></style>
