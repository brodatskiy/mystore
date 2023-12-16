<script setup>
import { ref } from "vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { useForm, Head } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/Admin/PrimaryButton.vue";

let props = defineProps(["user"]);
const form = useForm({
  _method: "put",
  name: props.user.name,
  email: props.user.email,
  age: props.user.age,
  address: props.user.address,
  gender: props.user.gender,
  role: props.user.role,
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
  { title: props.users.name, disabled: true, href: "users.index" },
]);
</script>

<template>
  <Head title="Edit user" />

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
        <h2 class="text-center mt-2">Edit user</h2>
        <form @submit.prevent="form.post(route('users.update', user.id))">
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
            :error="form.errors.role ? true : false"
            :error-messages="form.errors.role"
          ></v-select>
          <v-file-input
            @input="form.avatar = $event.target.files[0]"
            clearable
            variant="underlined"
            label="Choose avatar"
          ></v-file-input>
          <div class="d-flex justify-end">
            <PrimaryButton class="mt-2" type="submit"> Update </PrimaryButton>
          </div>
        </form>
      </div>
    </v-sheet>
  </AdminLayout>
</template>
<style></style>
