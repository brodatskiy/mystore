<script setup>
import { ref } from "vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const props = defineProps({
  canResetPassword: {
    type: Boolean,
  },
  status: {
    type: String,
  },
});

const form = useForm({
  email: "",
  password: "",
  remember: false,
});

const snackbar = ref(props.status);
const showPassword = ref(false);

const submit = () => {
  form.post(route("login"), {
    onFinish: () => form.reset("password"),
  });
};
</script>

<template>
  <GuestLayout>
    <Head title="Log in" />

    <v-form @submit.prevent="submit">
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

      <v-checkbox
        v-model="form.remember"
        density="compact"
        label="Remember me"
        name="remember"
      ></v-checkbox>

      <v-btn
        block
        type="submit"
        class="w-full"
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
        color="primary"
        size="large"
        variant="flat"
      >
        Log In
      </v-btn>

      <Link v-if="canResetPassword" :href="route('password.request')">
        <p class="text-indigo-darken-2">Forgot your password?</p>
      </Link>
    </v-form>

    <v-snackbar v-model="snackbar" rounded="xl">
      <p class="text-center">{{ status }}</p>
    </v-snackbar>
  </GuestLayout>
</template>

<style scoped></style>
