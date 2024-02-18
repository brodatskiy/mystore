<script setup>
import { ref } from "vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

import AdminLayout from "@/Layouts/AdminLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

let props = defineProps(["category"]);
const form = useForm({
  _method: "put",
  title: props.category.title,
});

let breadcrumbs = ref([
  { title: "Users", disabled: false, href: "users.index" },
  { title: "Category", disabled: true, href: "categories.index" },
]);
</script>

<template>
  <Head title="Edit category" />

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
      <div class="w-50 mx-auto">
        <h2 class="text-center mt-2">Edit category</h2>
        <form @submit.prevent="form.post(route('categories.update', category))">
          <v-text-field
            v-model="form.title"
            label="Title"
            variant="underlined"
            :error="form.errors.title ? true : false"
            :error-messages="form.errors.title"
          />

          <div class="d-flex justify-end">
            <PrimaryButton class="mt-2" type="submit"> Update </PrimaryButton>
          </div>
        </form>
      </div>
    </v-sheet>
  </AdminLayout>
</template>
<style></style>
