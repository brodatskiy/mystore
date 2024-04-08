<script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";

import { Head, useForm } from "@inertiajs/vue3";

const props = defineProps({
    email: {
        type: String,
        required: true,
    },
    token: {
        type: String,
        required: true,
    },
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: "",
    password_confirmation: "",
});

const submit = () => {
    form.post(route("password.store"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <AuthLayout>
        <Head title="Reset Password" />

        <v-form @submit.prevent="submit">
            <v-text-field
                v-model="form.email"
                class="mb-2"
                type="email"
                density="compact"
                variant="underlined"
                label="Email"
                prepend-inner-icon="mdi-email-outline"
                :error="form.errors.email ? true : false"
                :error-messages="form.errors.email"
            ></v-text-field>

            <v-text-field
                v-model="form.password"
                class="mb-2"
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
                Reset Password
            </v-btn>
        </v-form>
    </AuthLayout>
</template>
