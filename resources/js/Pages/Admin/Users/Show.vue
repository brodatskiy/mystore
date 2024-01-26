<script setup>
import { ref } from "vue";
import { Head, Link } from "@inertiajs/vue3";

import AdminLayout from "@/Layouts/AdminLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DungerButton from "@/Components/DangerButton.vue";
import AvatarPlaceholder from "~/assets/images/avatar-placeholder.png";

const props = defineProps(["user"]);

const breadcrumbs = ref([
  { title: "Dashboard", disabled: false, href: "dashboard.index" },
  { title: "Users", disabled: false, href: "users.index" },
  {
    title: String(props.user.id),
    disabled: true,
    href: "users.index",
  },
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
      <div class="d-flex">
        <div>
          <v-img
            v-if="user.avatar"
            :min-width="200"
            :src="user.avatar"
            alt="user avatar"
            class="w-full"
          />
          <v-img
            v-else
            :min-width="200"
            :src="AvatarPlaceholder"
            alt="user avatar"
            class="w-full"
          />
        </div>
        <div>
          <v-table class="ml-10">
            <tbody>
              <tr>
                <td>Name</td>
                <td>{{ user.name }}</td>
              </tr>
              <tr>
                <td>Age</td>
                <td>{{ user.age }}</td>
              </tr>
              <tr>
                <td>Address</td>
                <td>{{ user.address }}</td>
              </tr>
              <tr>
                <td>Gender</td>
                <td>{{ user.gender }}</td>
              </tr>
              <tr>
                <td>Email</td>
                <td>{{ user.email }}</td>
              </tr>
              <tr>
                <td>Role</td>
                <td>{{ user.role }}</td>
              </tr>
            </tbody>
          </v-table>
        </div>
      </div>
      <div class="px-4">
        <Link :href="route('users.edit', user)">
          <PrimaryButton> Edit </PrimaryButton>
        </Link>
        <Link
          method="delete"
          :href="route('users.destroy', user.id)"
          as="button"
          class="ml-2"
        >
          <DungerButton as="button"> Delete </DungerButton>
        </Link>
      </div>
    </v-sheet>
  </AdminLayout>
</template>
