<script setup>
import { ref } from "vue";
import { Head, Link } from "@inertiajs/vue3";

import AdminLayout from "@/Layouts/AdminLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DungerButton from "@/Components/DangerButton.vue";

const props = defineProps(["tags"]);

let breadcrumbs = ref([
  { title: "Dashboard", disabled: false, href: "dashboard.index" },
  { title: "Tags", disabled: true, href: "tags.index" },
]);
</script>

<template>
  <Head title="Tags" />

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
      <v-table fixed-header class="mt-6">
        <thead>
          <tr>
            <th class="text-left">Title</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="tag in tags" :key="tag.id">
            <td>{{ tag.title }}</td>
            <td class="text-right">
              <Link
                method="delete"
                :href="route('tags.destroy', tag)"
                as="button"
              >
                <DungerButton as="button"> Delete </DungerButton>
              </Link>
            </td>
          </tr>
        </tbody>
      </v-table>
      <div class="d-flex align-middle justify-center mt-4">
        <Link :href="route('tags.create')">
          <PrimaryButton>
            <v-icon class="mr-4" icon="mdi-plus"></v-icon>
            Add new tag
          </PrimaryButton>
        </Link>
      </div>
    </v-sheet>
  </AdminLayout>
</template>
<style scoped></style>
