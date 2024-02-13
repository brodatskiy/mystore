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
      <div class="d-flex align-middle justify-center mt-4">
        <Link :href="route('products.create')">
          <PrimaryButton>
            Add new product
            <v-icon class="ml-3" icon="mdi-plus"></v-icon>
          </PrimaryButton>
        </Link>
      </div>
      <v-table fixed-header class="mt-6">
        <thead>
          <tr>
            <th class="text-left">Image</th>
            <th class="text-left">Title</th>
            <th class="text-left">Price</th>
            <th class="text-left">Count</th>
            <th class="text-left">Published</th>
            <th class="text-left">Group</th>
            <th class="text-left">Category</th>
            <th class="text-left">Tags</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="product in products" :key="product.id">
            <td>
              <v-img
                :min-width="200"
                :src="product.image"
                alt="product image"
                class="w-full"
              />
            </td>
            <td>{{ product.title }}</td>
            <td>{{ product.price }}</td>
            <td>{{ product.count }}</td>
            <td>{{ product.is_published ? "Yes" : "No" }}</td>
            <td>{{ product.group.title }}</td>
            <td>{{ product.category.title }}</td>
            <td>
              <div v-for="tag in product.tags" :key="tag.id" class="pa-1">
                <v-chip>
                  {{ tag.title }}
                </v-chip>
              </div>
            </td>
            <td class="text-right">
              <Link :href="route('products.show', product)">
                <PrimaryButton> Show </PrimaryButton>
              </Link>
            </td>
            <td class="text-right">
              <Link
                method="delete"
                :href="route('products.destroy', product.id)"
                as="button"
              >
                <DungerButton as="button"> Delete </DungerButton>
              </Link>
            </td>
          </tr>
        </tbody>
      </v-table>
    </v-sheet>
  </AdminLayout>
</template>
<style scoped></style>
