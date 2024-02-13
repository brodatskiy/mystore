<script setup>
import { ref } from "vue";
import { Head, Link } from "@inertiajs/vue3";

import AdminLayout from "@/Layouts/AdminLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DungerButton from "@/Components/DangerButton.vue";
import AvatarPlaceholder from "~/assets/images/avatar-placeholder.png";

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
        <div>
          <v-img
            :min-width="200"
            :src="product.image"
            alt="product avatar"
            class="w-full"
          />
        </div>
        <div>
          <v-table class="ml-10">
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
                <td>Content</td>
                <td>{{ product.content }}</td>
              </tr>
              <tr>
                <td>Price</td>
                <td>{{ product.price }}</td>
              </tr>
              <tr>
                <td>Count</td>
                <td>{{ product.count }}</td>
              </tr>
              <tr>
                <td>Is published</td>
                <td>{{ product.isPublished ? "Yes" : "No" }}</td>
              </tr>
              <tr>
                <td>Group</td>

                <td>{{ product.group.title }}</td>
              </tr>
              <tr>
                <td>Category</td>
                <td>{{ product.category.title }}</td>
              </tr>
              <tr>
                <td>Tags</td>
                <div v-for="tag in product.tags" :key="tag.id" class="pa-1">
                  <v-chip>
                    {{ tag.title }}
                  </v-chip>
                </div>
              </tr>
            </tbody>
          </v-table>
        </div>
      </div>
      <div class="px-4">
        <Link :href="route('products.edit', product)">
          <PrimaryButton> Edit </PrimaryButton>
        </Link>
        <Link
          method="delete"
          :href="route('products.destroy', product.id)"
          as="button"
          class="ml-2"
        >
          <DungerButton as="button"> Delete </DungerButton>
        </Link>
      </div>
    </v-sheet>
  </AdminLayout>
</template>
