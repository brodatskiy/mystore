<script setup>
import { ref } from "vue";
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

defineProps({
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

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>
        <v-form @submit.prevent="submit">
            <v-text-field
                type="email"
                v-model="form.email"
                variant="solo"
                density="compact"
                flat
                class="h-25"
                rounded="xl"
                label="Email"
                bg-color=""
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
                variant="solo"
                flat
                label="Password"
                rounded="xl"
                :error="form.errors.password ? true : false"
                :error-messages="form.errors.password"
                @click:append-inner="showPassword = !showPassword"
            ></v-text-field>

            <div class="">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ml-2">Remember me</span>
                </label>
            </div>

            <div class="mt-4">
                <v-btn
                    block
                    type="submit"
                    class="w-full"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    color="primary"
                    size="large"
                    variant="flat"
                    rounded="xl"
                >
                    Log In
                </v-btn>
            </div>
            <div class="mt-2">
                <Link v-if="canResetPassword" :href="route('password.request')">
                    Forgot your password?
                </Link>
            </div>
        </v-form>
    </GuestLayout>
</template>

<style scoped></style>
