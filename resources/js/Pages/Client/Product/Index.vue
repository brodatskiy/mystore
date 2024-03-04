<script setup>
import { computed } from "vue";
import MainLayout from "@/Layouts/MainLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

// import { useProductStore } from "@/Store/useProductStore";
// import { useCartStore } from "@/Store/useCartStore";
// import { toCurrency } from "@/Utils/toCurrency";

// const productStore = useProductStore();
// const cartStore = useCartStore();

const props = defineProps(["product"]);
</script>
<template>
  <Head title="Product" />

  <MainLayout>
    <v-sheet class="pa-2" rounded="xl">
      <v-container fluid>
        <v-row>
          <v-col>
            <div>
              <v-img
                height="600"
                min-width="400"
                :src="product.image"
                rounded="xl"
                cover
              >
                <v-card-title class="px-4 text-white text-right">
                  {{ product.sticker.title.toUpperCase() }}</v-card-title
                >
              </v-img>
            </div>
          </v-col>

          <v-col class="d-flex flex-column" md="4">
            <div class="text-h2 mb-2">{{ product.title }}</div>
            <div class="text-h5 mb-2">{{ product.price }} $</div>
            <div class="mb-2">
              <v-slide-group show-arrows>
                <v-slide-group-item
                  v-for="subProduct in product.product_group"
                  :key="subProduct.id"
                  v-slot="{ toggle, selectedClass }"
                >
                  <div class="mx-1">
                    <v-card :class="[selectedClass]">
                      <v-img
                        :src="subProduct.image"
                        alt="Card Image"
                        width="70"
                        cover
                        @click="toggle"
                      />
                    </v-card>
                  </div>
                </v-slide-group-item>
              </v-slide-group>
            </div>
            <div class="d-flex mb-2 overflow-hidden">
              <div v-for="size in product.sizes">
                <div v-if="size.count > 0" class="mr-1">
                  <v-btn variant="outlined" size="small">
                    {{ size.title }}
                  </v-btn>
                </div>
              </div>
            </div>
            <div class="text-md mb-2">{{ product.description }}</div>

            <PrimaryButton
              class="w-100 mt-auto"
              @click.stop="cartStore.add(product)"
            >
              Add to cart
            </PrimaryButton>
          </v-col>
        </v-row>
      </v-container>
      <div class="mt-4">
        <v-chip v-for="tag in product.tags" class="mr-2">{{
          tag.title
        }}</v-chip>
      </div>
    </v-sheet>
  </MainLayout>
</template>
<style scoped></style>
