<script setup>
import { ref } from "vue";
import AuthLayout from "@/Layouts/AuthLayout.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    status: {
        type: String,
    },
});

const snackbar = ref(props.status);

const form = useForm({
    email: "",
});

const submit = () => {
    form.post(route("password.email"));
};
</script>

<template>
    <AuthLayout>
        <Head title="Forgot Password" />

        <div class="mb-4 text-body-1">
            Forgot your password? No problem. Just let us know your email
            address and we will email you a password reset link that will allow
            you to choose a new one.
        </div>

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
        </v-form>
        <v-snackbar v-model="snackbar" rounded="xl">
            <p class="text-center">{{ status }}</p>
        </v-snackbar>
    </AuthLayout>
</template>
