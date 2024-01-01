<script setup>
import { ref } from "vue";
import { useForm, Head, Link } from "@inertiajs/vue3";

import AdminLayout from "@/Layouts/AdminLayout.vue";
import PrimaryButton from "@/Components/Admin/PrimaryButton.vue";

const form = useForm({
  title: "",
});

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
      <div class="w-50 mx-auto">
        <h2 class="text-center">Add new category</h2>
        <v-form @submit.prevent="form.post(route('tags.store'))">
          <v-text-field
            v-model="form.title"
            label="Title"
            variant="underlined"
            :error="form.errors.title ? true : false"
            :error-messages="form.errors.title"
          />

          <div class="d-flex justify-end">
            <PrimaryButton class="mt-2" type="submit"> Create </PrimaryButton>
          </div>
        </v-form>
      </div>
    </v-sheet>
  </AdminLayout>
</template>
<style></style>
