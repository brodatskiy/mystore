<script setup>
import { computed } from "vue";
import AuthLayout from "@/Layouts/AuthLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const props = defineProps({
  status: {
    type: String,
  },
});

const form = useForm({});

const submit = () => {
  form.post(route("verification.send"));
};

const verificationLinkSent = computed(
  () => props.status === "verification-link-sent"
);
const snackbar = ref(verificationLinkSent);
</script>

<template>
  <AuthLayout>
    <Head title="Email Verification" />

    <div class="mb-4">
      Thanks for signing up! Before getting started, could you verify your email
      address by clicking on the link we just emailed to you? If you didn't
      receive the email, we will gladly send you another.
    </div>

    <v-form @submit.prevent="submit">
      <div class="mt-4 d-flex align-center justify-space-between">
        <v-btn
          block
          type="submit"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
          color="primary"
          size="large"
          variant="flat"
        >
          Log In
        </v-btn>

        <Link :href="route('logout')" method="post" as="button">Log Out</Link>
      </div>
    </v-form>
    <v-snackbar v-model="snackbar" rounded="xl">
      <p class="text-center">
        A new verification link has been sent to the email address you provided
        during registration.
      </p>
    </v-snackbar>
  </AuthLayout>
</template>
