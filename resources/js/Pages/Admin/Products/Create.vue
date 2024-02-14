<script setup>
import { ref } from "vue";
import { useForm, Head, Link } from "@inertiajs/vue3";

import AdminLayout from "@/Layouts/AdminLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

let props = defineProps({
  groups: Array,
  categories: Array,
  tags: Array,
});

const form = useForm({
  title: "",
  description: "",
  content: "",
  preview_image: "",
  price: "",
  count: "",
  is_published: true,
  group_id: "",
  category_id: "",
  tags: [],
});

let breadcrumbs = ref([
  { title: "Products", disabled: false, href: "products.index" },
]);
</script>

<template>
  <Head title="Products" />

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
        <h2 class="text-center">Add new product</h2>
        <v-form @submit.prevent="form.post(route('products.store'))">
          <v-text-field
            v-model="form.title"
            label="Title"
            variant="underlined"
            :error="form.errors.title ? true : false"
            :error-messages="form.errors.title"
          />

          <v-text-field
            v-model="form.description"
            label="Description"
            variant="underlined"
            :error="form.errors.description ? true : false"
            :error-messages="form.errors.description"
          />

          <v-text-field
            v-model="form.content"
            label="Content"
            variant="underlined"
            :error="form.errors.content ? true : false"
            :error-messages="form.errors.content"
          />

          <v-text-field
            v-model="form.price"
            type="number"
            label="Price"
            variant="underlined"
            :error="form.errors.price ? true : false"
            :error-messages="form.errors.price"
          />

          <v-text-field
            v-model="form.count"
            type="number"
            label="Count"
            variant="underlined"
            :error="form.errors.count ? true : false"
            :error-messages="form.errors.count"
          />

          <v-select
            v-model="form.group_id"
            item-value="id"
            variant="underlined"
            label="Group"
            :items="groups"
            :error="form.errors.group_id ? true : false"
            :error-messages="form.errors.group_id"
          ></v-select>

          <v-select
            v-model="form.category_id"
            item-value="id"
            variant="underlined"
            label="Category"
            :items="categories"
            :error="form.errors.category_id ? true : false"
            :error-messages="form.errors.category_id"
          ></v-select>

          <v-select
            v-model="form.tags"
            item-value="id"
            variant="underlined"
            label="Tags"
            multiple
            chips
            :items="tags"
            :error="form.errors.tags ? true : false"
            :error-messages="form.errors.tags"
          ></v-select>

          <v-file-input
            @input="form.preview_image = $event.target.files[0]"
            clearable
            variant="underlined"
            label="Choose preview image"
            :error="form.errors.preview_image ? true : false"
            :error-messages="form.errors.preview_image"
          ></v-file-input>

          <v-checkbox
            v-model="form.is_published"
            label="Is published"
          ></v-checkbox>

          <PrimaryButton class="w-100 mt-3" type="submit">
            Create
          </PrimaryButton>
        </v-form>
      </div>
    </v-sheet>
  </AdminLayout>
</template>
<style></style>
