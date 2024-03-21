<script setup>
import { ref } from "vue";
import { useForm, usePage } from "@inertiajs/vue3";
import InputError from "@/Components/Input/InputError.vue";
import InputLabel from "@/Components/Input/InputLabel.vue";
import TextInput from "@/Components/Input/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
  mustVerifyEmail: Boolean,
  status: String,
});

const genderItems = ref([
  { value: 1, title: "Male" },
  { value: 2, title: "Female" },
]);

const user = usePage().props.auth.user;

const form = useForm({
  _method: "patch",
  name: user.name,
  email: user.email,
  age: user.age,
  address: user.address,
  gender: user.gender,
  role: user.role,
  avatar: "",
});
</script>

<template>
  <section>
    <header>
      <h2 class="text-lg font-medium text-gray-900">Profile Information</h2>

      <p class="mt-1 text-sm text-gray-600">
        Update your account's profile information and email address.
      </p>
    </header>

    <form @submit.prevent="form.post(route('profile.update', user.id))">
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
  </section>
</template>
