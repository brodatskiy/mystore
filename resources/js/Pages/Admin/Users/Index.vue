<script setup>
import { ref } from "vue";
import { Head, Link } from "@inertiajs/vue3";

import AdminLayout from "@/Layouts/AdminLayout.vue";
import LinkButton from "@/Components/LinkButton.vue";

const props = defineProps(["users"]);

let breadcrumbs = ref([
  { title: "Dashboard", disabled: false, href: "dashboard.index" },
  { title: "Users", disabled: true, href: "users.index" },
]);
</script>

<template>
  <Head title="Users" />

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
        <LinkButton :href="route('users.create')">
          Add new user
          <v-icon class="ml-3" icon="mdi-account-plus"></v-icon>
        </LinkButton>
      </div>
      <v-table fixed-header class="">
        <thead>
          <tr>
            <th class="text-center">Name</th>
            <th class="text-center">Age</th>
            <th class="text-center">Address</th>
            <th class="text-center">Gender</th>
            <th class="text-center">Email</th>
            <th class="text-center">Role</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id">
            <td class="text-left">{{ user.name }}</td>
            <td class="text-left">{{ user.age }}</td>
            <td class="text-left">{{ user.address }}</td>
            <td class="text-left">{{ user.gender }}</td>
            <td class="text-left">{{ user.email }}</td>
            <td class="text-left">{{ user.role }}</td>
            <td class="text-left">
              <LinkButton :href="route('users.show', user)"> Show </LinkButton>
              <LinkButton
                :href="route('users.destroy', user.id)"
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
