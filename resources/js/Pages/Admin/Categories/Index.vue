<script setup>
import { ref } from "vue";
import { Head, Link } from "@inertiajs/vue3";

import AdminLayout from "@/Layouts/AdminLayout.vue";
import PrimaryButton from "@/Components/Admin/PrimaryButton.vue";
import DungerButton from "@/Components/Admin/DangerButton.vue";

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
      <v-table fixed-header class="mt-6" color="inherit">
        <thead>
          <tr>
            <th class="text-left">Title</th>
            <th class="text-center"></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="category in categories" :key="category.id">
            <td>{{ category.title }}</td>
            <td class="text-center px-0">
              <Link
                method="delete"
                :href="route('categories.destroy', category.id)"
              >
                <DungerButton as="button"> Delete </DungerButton>
              </Link>
            </td>
          </tr>
        </tbody>
      </v-table>
      <div class="d-flex align-middle justify-center mt-4">
        <Link :href="route('categories.create')">
          <PrimaryButton>
            <v-icon class="mr-4" icon="mdi-account-plus"></v-icon>
            Add new user
          </PrimaryButton>
        </Link>
      </div>
    </v-sheet>
  </AdminLayout>
</template>
<style scoped></style>
