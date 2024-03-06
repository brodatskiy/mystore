<script setup>
import { ref } from "vue";
import { Head, Link } from "@inertiajs/vue3";

import AdminLayout from "@/Layouts/AdminLayout.vue";
import LinkButton from "@/Components/LinkButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps(["categories"]);

let breadcrumbs = ref([
  { title: "Dashboard", disabled: false, href: "dashboard.index" },
  { title: "Categories", disabled: true, href: "categories.index" },
]);
</script>

<template>
  <Head title="Categories" />

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
        <PrimaryButton :href="route('categories.create')">
          Add new category
          <v-icon class="ml-3" icon="mdi-plus"></v-icon>
        </PrimaryButton>
      </div>
      <v-table fixed-header class="">
        <thead>
          <tr>
            <th class="text-left">Title</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="category in categories" :key="category.id">
            <td>{{ category.title }}</td>
            <td class="text-right">
              <LinkButton :href="route('categories.edit', category)">
                Edit
              </LinkButton>

              <LinkButton
                :href="route('categories.destroy', category)"
                method="delete"
                as="button"
                class="ml-2 bg-error"
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
<style scoped></style>
