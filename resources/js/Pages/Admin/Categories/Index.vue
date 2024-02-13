<script setup>
import { ref } from "vue";
import { Head, Link } from "@inertiajs/vue3";

import AdminLayout from "@/Layouts/AdminLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DungerButton from "@/Components/DangerButton.vue";

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
      <div class="d-flex align-middle justify-center mt-4">
        <Link :href="route('categories.create')">
          <PrimaryButton>
            <v-icon class="mr-4" icon="mdi-plus"></v-icon>
            Add new category
          </PrimaryButton>
        </Link>
      </div>
      <v-table fixed-header class="mt-6">
        <thead>
          <tr>
            <th class="text-left">Title</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="category in categories" :key="category.id">
            <td>{{ category.title }}</td>
            <td class="text-right">
              <Link :href="route('categories.edit', category)">
                <PrimaryButton> Edit </PrimaryButton>
              </Link>

              <Link
                method="delete"
                :href="route('categories.destroy', category)"
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
