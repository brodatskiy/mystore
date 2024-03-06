<script setup>
import { ref } from "vue";

import AdminLayout from "@/Layouts/AdminLayout.vue";
import LinkButton from "@/Components/LinkButton.vue";

const props = defineProps(["product"]);

const breadcrumbs = ref([
  { title: "Dashboard", disabled: false, href: "dashboard.index" },
  { title: "Products", disabled: false, href: "products.index" },
  {
    title: String(props.product.id),
    disabled: true,
    href: "products.index",
  },
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
      <div class="d-flex">
        <div class="w-25">
          <v-img
            :min-width="200"
            :src="product.image"
            alt="product avatar"
            rounded="xl"
          />
          <v-table density="compact" class="mt-2">
            <thead>
              <tr>
                <th class="text-center">Size</th>
                <th class="text-center">Count</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="size in product.sizes" :key="size.title">
                <td class="text-center">{{ size.title }}</td>
                <td class="text-center">{{ size.count }}</td>
              </tr>
            </tbody>
          </v-table>
        </div>
        <div class="flex-grow-1">
          <div class="d-flex justify-end ml-5">
            <LinkButton :href="route('products.edit', product)">
              Edit
            </LinkButton>
            <LinkButton
              :href="route('products.destroy', product.id)"
              method="delete"
              as="button"
              class="ml-2 bg-error"
            >
              Delete
            </LinkButton>
          </div>
          <v-table class="ml-5">
            <tbody>
              <tr>
                <td>Title</td>
                <td>{{ product.title }}</td>
              </tr>
              <tr>
                <td>Description</td>
                <td>{{ product.description }}</td>
              </tr>
              <tr>
                <td>Price</td>
                <td>{{ product.price }}</td>
              </tr>
              <tr>
                <td>Color</td>
                <td>
                  <v-sheet
                    width="30"
                    height="30"
                    :color="product.color"
                    rounded="xl"
                  ></v-sheet>
                </td>
              </tr>
              <tr></tr>
              <tr>
                <td>Is published</td>
                <td>{{ product.is_published ? "Yes" : "No" }}</td>
              </tr>
              <tr>
                <td>Group</td>

                <td>{{ product.group.title ?? "no group" }}</td>
              </tr>
              <tr>
                <td>Category</td>
                <td>{{ product.category.title }}</td>
              </tr>
              <tr>
                <td>Tags</td>
                <td>
                  <v-chip
                    v-for="tag in product.tags"
                    :key="tag.id"
                    class="ma-1"
                  >
                    {{ tag.title }}
                  </v-chip>
                </td>
              </tr>
            </tbody>
          </v-table>
        </div>
      </div>
    </v-sheet>
  </AdminLayout>
</template>
