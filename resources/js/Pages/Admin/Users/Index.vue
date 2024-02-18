<script setup>
import { ref } from "vue";
import { Head, Link } from "@inertiajs/vue3";

import AdminLayout from "@/Layouts/AdminLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DungerButton from "@/Components/DangerButton.vue";

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
      <v-table fixed-header class="mt-6">
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
              <Link :href="route('users.show', user)">
                <PrimaryButton> Show </PrimaryButton>
              </Link>
              <Link
                method="delete"
                :href="route('users.destroy', user.id)"
                as="button"
                class="ml-2"
              >
                <DungerButton as="button"> Delete </DungerButton>
              </Link>
            </td>
          </tr>
        </tbody>
      </v-table>
      <div class="d-flex align-middle justify-center mt-4">
        <Link :href="route('users.create')">
          <PrimaryButton>
            Add new user
            <v-icon class="ml-3" icon="mdi-account-plus"></v-icon>
          </PrimaryButton>
        </Link>
      </div>
    </v-sheet>
  </AdminLayout>
</template>
<style scoped></style>
