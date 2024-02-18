<script setup>
import { ref } from "vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

import AdminLayout from "@/Layouts/AdminLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

let props = defineProps({
  product: Object,
  groups: Array,
  categories: Array,
  tags: Array,
});

const form = useForm({
  _method: "put",
  title: props.product.title,
  description: props.product.description,
  content: props.product.content,
  preview_image: null,
  price: props.product.price,
  color: props.product.color,
  count: props.product.count,
  is_published: !!props.product.is_published,
  group_id: props.product.group.id,
  category_id: props.product.category.id,
  tags: props.product.tags,
});

let breadcrumbs = ref([
  { title: "products", disabled: false, href: "products.index" },
  {
    title: String(props.product.title),
    disabled: true,
    href: "products.index",
  },
]);
</script>

<template>
  <Head title="Edit product" />
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
        <h2 class="text-center mt-2">Edit product</h2>
        <form @submit.prevent="form.post(route('products.update', product))">
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
            v-model="form.price"
            type="number"
            label="Price"
            variant="underlined"
            :error="form.errors.price ? true : false"
            :error-messages="form.errors.price"
          />

          <v-color-picker v-model="form.color" hide-inputs></v-color-picker>

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
            Update
          </PrimaryButton>
        </form>
      </div>
    </v-sheet>
  </AdminLayout>
</template>
<style></style>
