<script setup>
import { ref } from "vue";
import { Head, Link } from "@inertiajs/vue3";

import AdminLayout from "@/Layouts/AdminLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DungerButton from "@/Components/DangerButton.vue";

const props = defineProps({ products: Object });

let breadcrumbs = ref([
  { title: "Dashboard", disabled: false, href: "dashboard.index" },
  { title: "Products", disabled: true, href: "products.index" },
]);
</script>

<template>
  <Head title="Products" />

  <AdminLayout>
    <v-breadcrumbs :items="breadcrumbs">
      <template v-slot:title="{ item }">
        <Link :href="route(item.href)">
          {{ item.title }}
        </Link>
      </template>
      <template v-slot:divider>
        <v-icon icon="mdi-chevron-right"></v-icon>
      </template>
    </v-breadcrumbs>

    <v-sheet class="pa-4" rounded="xl" elevation="3">
      <div class="d-flex align-middle justify-center">
        <Link :href="route('products.create')">
          <PrimaryButton>
            Add new product
            <v-icon class="ml-3" icon="mdi-plus"></v-icon>
          </PrimaryButton>
        </Link>
      </div>
      <v-table fixed-header class="">
        <thead>
          <tr>
            <th class="text-center">Image</th>
            <th class="text-center">Title</th>
            <th class="text-center">Price</th>
            <th class="text-center">Color</th>
            <th class="text-center">Published</th>
            <th class="text-center">Group</th>
            <th class="text-center">Category</th>
            <th class="text-center">Tags</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="product in products" :key="product.id" height="100">
            <td>
              <v-img
                :min-width="60"
                :src="product.image"
                alt="product image"
                rounded="xl"
              />
            </td>
            <td class="text-center">{{ product.title }}</td>
            <td class="text-center">{{ product.price }}</td>
            <td class="text-center">
              <v-sheet
                width="30"
                height="30"
                :color="product.color"
                rounded="xl"
              ></v-sheet>
            </td>
            <td class="text-center">
              {{ product.is_published ? "Yes" : "No" }}
            </td>
            <td class="text-center">{{ product.group.title }}</td>
            <td class="text-center">{{ product.category.title }}</td>
            <td class="text-center">
              <v-chip v-for="tag in product.tags" :key="tag.id" class="ma-1">
                {{ tag.title }}
              </v-chip>
            </td>
            <td class="text-center">
              <Link :href="route('products.show', product)">
                <PrimaryButton> Show </PrimaryButton>
              </Link>
              <Link
                method="delete"
                :href="route('products.destroy', product.id)"
                as="button"
              >
                <DungerButton as="button" class="ml-2"> Delete </DungerButton>
              </Link>
            </td>
          </tr>
        </tbody>
      </v-table>
    </v-sheet>
  </AdminLayout>
</template>
<style scoped></style>
