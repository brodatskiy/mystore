<script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";

const form = useForm({
  password: "",
});

const submit = () => {
  form.post(route("password.confirm"), {
    onFinish: () => form.reset(),
  });
};
</script>

<template>
  <AuthLayout>
    <Head title="Confirm Password" />

    <div class="mb-4">
      This is a secure area of the application. Please confirm your password
      before continuing.
    </div>

    <v-form @submit.prevent="submit">
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

      <v-btn
        block
        type="submit"
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
        color="primary"
        size="large"
        variant="flat"
      >
        Confirm
      </v-btn>
    </v-form>
  </AuthLayout>
</template>
