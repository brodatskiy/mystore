<script setup>
import { ref } from "vue";
import { Head, Link } from "@inertiajs/vue3";

import AdminLayout from "@/Layouts/AdminLayout.vue";
import PrimaryButton from "@/Components/Admin/PrimaryButton.vue";
import DungerButton from "@/Components/Admin/DangerButton.vue";

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
      <v-table fixed-header class="mt-6" color="inherit">
        <thead>
          <tr>
            <th class="text-left">Name</th>
            <th class="text-left">Age</th>
            <th class="text-left">Address</th>
            <th class="text-left">Gender</th>
            <th class="text-left">Email</th>
            <th class="text-left">Role</th>
            <th class="text-center"></th>
            <th class="text-center"></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id">
            <td>{{ user.name }}</td>
            <td>{{ user.age }}</td>
            <td>{{ user.address }}</td>
            <td>{{ user.gender }}</td>
            <td>{{ user.email }}</td>
            <td>{{ user.role }}</td>
            <td class="text-center px-0">
              <Link :href="route('users.show', user)">
                <PrimaryButton> Show </PrimaryButton>
              </Link>
            </td>
            <td class="text-center px-0">
              <Link :href="route('users.destroy', user.id)">
                <DungerButton method="delete" as="button">
                  Delete
                </DungerButton>
              </Link>
            </td>
          </tr>
        </tbody>
      </v-table>
      <div class="d-flex align-middle justify-center mt-4">
        <Link :href="route('users.create')">
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
