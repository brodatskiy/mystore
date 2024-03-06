<script setup>
import { ref } from "vue";

import AdminLayout from "@/Layouts/AdminLayout.vue";
import LinkButton from "@/Components/LinkButton.vue";

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
        <LinkButton :href="route('groups.create')">
          Add new group
          <v-icon class="ml-3" icon="mdi-plus"></v-icon>
        </LinkButton>
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
              <LinkButton :href="route('groups.show', group)">
                Show
              </LinkButton>

              <LinkButton :href="route('groups.edit', group)" class="ml-2">
                Edit
              </LinkButton>

              <LinkButton
                method="delete"
                :href="route('groups.destroy', group.id)"
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
<style scoped></style>
