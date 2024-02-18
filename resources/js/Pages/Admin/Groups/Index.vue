<script setup>
import { ref } from "vue";
import { Head, Link } from "@inertiajs/vue3";

import AdminLayout from "@/Layouts/AdminLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DungerButton from "@/Components/DangerButton.vue";

const props = defineProps({ groups: Object });

let breadcrumbs = ref([
  { title: "Dashboard", disabled: false, href: "dashboard.index" },
  { title: "Groups", disabled: true, href: "groups.index" },
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
        <Link :href="route('groups.create')">
          <PrimaryButton>
            Add new group
            <v-icon class="ml-3" icon="mdi-plus"></v-icon>
          </PrimaryButton>
        </Link>
      </div>
      <v-table fixed-header class="">
        <thead>
          <tr>
            <th class="text-left">Title</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="group in groups" :key="group.id">
            <td>{{ group.title }}</td>

            <td class="text-right">
              <Link :href="route('groups.show', group)">
                <PrimaryButton> Show </PrimaryButton>
              </Link>

              <Link :href="route('groups.edit', group)">
                <PrimaryButton class="ml-2"> Edit </PrimaryButton>
              </Link>

              <Link
                method="delete"
                :href="route('groups.destroy', group.id)"
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
