<script setup>
import { ref } from "vue";
import AuthLayout from "@/Layouts/AuthLayout.vue";
import { useForm } from "@inertiajs/vue3";
import { useToast } from "primevue/usetoast";

import Btn from "@/Components/Btn.vue";
import Toast from "primevue/toast";
import IconField from "primevue/iconfield";
import InputIcon from "primevue/inputicon";
import InputError from "@/Components/InputError.vue";

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

const toast = useToast();
const visible = ref(false);

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <AuthLayout>
        <Head title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div class="flex flex-col gap-3">
                <div>
                    <IconField iconPosition="left">
                        <InputIcon>
                            <Icon
                                icon="mdi:email"
                                width="1.5rem"
                                height="1.5rem"
                                class="-mt-1"
                            ></Icon>
                        </InputIcon>

                        <InputText
                            v-model="form.email"
                            id="email"
                            type="email"
                            placeholder="Email"
                            class="peer pl-10 w-full"
                            :invalid="form.errors.email"
                        />
                    </IconField>
                    <InputError class="mt-1" :message="form.errors.email" />
                </div>
                <div>
                    <IconField iconPosition="left">
                        <InputIcon>
                            <Icon
                                icon="mdi:password"
                                width="1.5rem"
                                height="1.5rem"
                                class="-mt-1"
                            ></Icon>
                        </InputIcon>
                        <InputText
                            v-model="form.password"
                            type="password"
                            placeholder="Password"
                            class="pl-10 w-full"
                            :invalid="form.errors.password"
                        />
                    </IconField>
                    <InputError class="mt-1" :message="form.errors.password" />
                </div>
                <div class="flex items-center">
                    <Checkbox
                        v-model="form.remember"
                        inputId="remember"
                        :binary="true"
                        value="Cheese"
                    />
                    <label for="remember" class="ml-2"> Remember me</label>
                </div>
                <Btn type="submit" class="w-full">Log In</Btn>
                <Link v-if="canResetPassword" :href="route('password.request')">
                    <p class="text-blue-600 hover:text-blue-900">
                        Forgot your password?
                    </p>
                </Link>
            </div>
        </form>

        <Toast position="bottom-center">
            <span>{{ status }}</span>
        </Toast>
    </AuthLayout>
</template>

<style scoped></style>
