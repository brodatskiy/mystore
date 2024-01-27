<script setup>
import { ref } from "vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const form = useForm({
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
});

const showPassword = ref(false);

const submit = () => {
  form.post(route("register"), {
    onFinish: () => form.reset("password", "password_confirmation"),
  });
};
</script>

<template>
  <GuestLayout>
    <Head title="Register" />

    <form @submit.prevent="submit">
      <v-text-field
        type="name"
        v-model="form.name"
        density="compact"
        variant="underlined"
        label="name"
        prepend-inner-icon="mdi-account-outline"
        :error="form.errors.name ? true : false"
        :error-messages="form.errors.name"
      ></v-text-field>

      <v-text-field
        type="email"
        v-model="form.email"
        density="compact"
        variant="underlined"
        label="Email"
        prepend-inner-icon="mdi-email-outline"
        :error="form.errors.email ? true : false"
        :error-messages="form.errors.email"
      ></v-text-field>

      <v-text-field
        v-model="form.password"
        :append-inner-icon="showPassword ? 'mdi-eye-off' : 'mdi-eye'"
        :type="showPassword ? 'text' : 'password'"
        density="compact"
        placeholder="Enter your password"
        prepend-inner-icon="mdi-lock-outline"
        variant="underlined"
        label="Password"
        :error="form.errors.password ? true : false"
        :error-messages="form.errors.password"
        @click:append-inner="showPassword = !showPassword"
      ></v-text-field>

      <v-text-field
        v-model="form.password_confirmation"
        :append-inner-icon="showPassword ? 'mdi-eye-off' : 'mdi-eye'"
        :type="showPassword ? 'text' : 'password'"
        density="compact"
        placeholder="Enter your password"
        prepend-inner-icon="mdi-lock-outline"
        variant="underlined"
        label="Password confirmation"
        :error="form.errors.password ? true : false"
        :error-messages="form.errors.password"
        @click:append-inner="showPassword = !showPassword"
      ></v-text-field>

      <v-btn
        block
        type="submit"
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
        color="primary"
        size="large"
        variant="flat"
      >
        Register
      </v-btn>

      <Link :href="route('login')">
        <p class="text-indigo-darken-2">Already registered?</p>
      </Link>
    </form>
  </GuestLayout>
</template>
