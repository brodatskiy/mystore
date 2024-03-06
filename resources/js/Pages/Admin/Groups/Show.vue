<script setup>
import { ref } from "vue";

import AdminLayout from "@/Layouts/AdminLayout.vue";
import LinkButton from "@/Components/LinkButton.vue";

const props = defineProps(["products"]);

const breadcrumbs = ref([
  { title: "Dashboard", disabled: false, href: "dashboard.index" },
  { title: "Groups", disabled: false, href: "groups.index" },
]);
</script>

<template>
  <Head title="Groups" />

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
        <LinkButton :href="route('products.create')">
          Add new product
          <v-icon class="ml-3" icon="mdi-plus"></v-icon>
        </LinkButton>
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
          <tr v-for="product in products" :key="product.id">
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
              <LinkButton :href="route('products.show', product)">
                Show
              </LinkButton>

              <LinkButton
                :href="route('products.destroy', product.id)"
                method="delete"
                class="ml-2 bg-error"
                as="button"
              >
                Delete
              </LinkButton>
            </td>
          </tr>
        </tbody>
      </v-table>
    </v-sheet>
  </AdminLayout>
</template>
