<script setup>
import { ref } from "vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { useForm, Head } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";

import PrimaryButton from "@/Components/Admin/PrimaryButton.vue";

const form = useForm({
  name: "",
  email: "",
  age: "",
  address: "",
  gender: "",
  role: 0,
  avatar: "",
});

const genderItems = ref([
  { value: 1, title: "Male" },
  { value: 2, title: "Female" },
]);
const roleItems = ref([
  { value: 0, title: "User" },
  { value: 1, title: "Admin" },
]);

let breadcrumbs = ref([
  { title: "Users", disabled: false, href: "users.index" },
]);
</script>

<template>
  <Head title="Users" />

  <AdminLayout>
    <div>
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
    </div>
    <v-sheet class="pa-4" rounded="xl" elevation="3">
      <div class="w-50 mx-auto">
        <h2 class="text-center">Add new user</h2>
        <v-form @submit.prevent="form.post(route('users.store'))">
          <v-text-field
            v-model="form.name"
            label="Name"
            variant="underlined"
            :error="form.errors.name ? true : false"
            :error-messages="form.errors.name"
          />
          <v-text-field
            v-model="form.email"
            label="Email"
            variant="underlined"
            :error="form.errors.email ? true : false"
            :error-messages="form.errors.email"
          />
          <v-text-field v-model="form.age" label="Age" variant="underlined" />
          <v-text-field
            v-model="form.address"
            label="Address"
            variant="underlined"
          />
          <v-select
            v-model="form.gender"
            item-value="value"
            variant="underlined"
            label="Gender"
            :items="genderItems"
          ></v-select>
          <v-select
            v-model="form.role"
            item-value="value"
            variant="underlined"
            label="Role"
            :items="roleItems"
          ></v-select>

          <v-file-input
            @input="form.avatar = $event.target.files[0]"
            clearable
            variant="underlined"
            label="Choose avatar"
          ></v-file-input>
          <div class="d-flex justify-end">
            <PrimaryButton class="mt-2" type="submit"> Create </PrimaryButton>
          </div>
        </v-form>
      </div>
    </v-sheet>
  </AdminLayout>
</template>
<style></style>
