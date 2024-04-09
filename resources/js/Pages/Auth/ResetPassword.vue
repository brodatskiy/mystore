<script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";
import { useForm } from "@inertiajs/vue3";

import IconField from "primevue/iconfield";
import InputIcon from "primevue/inputicon";
import InputError from "@/Components/InputError.vue";
import PrimaryBtn from "@/Components/Buttons/PrimaryBtn.vue";

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
                            class="pl-10 w-full"
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
                        />
                    </IconField>
                    <InputError class="mt-1" :message="form.errors.password" />
                </div>

                <div>
                    <IconField iconPosition="left">
                        <InputIcon>
                            <Icon
                                icon="mdi:lock-outline"
                                width="1.5rem"
                                height="1.5rem"
                                class="-mt-1"
                            ></Icon>
                        </InputIcon>
                        <InputText
                            v-model="form.password_confirmation"
                            type="password"
                            placeholder="Password"
                            class="pl-10 w-full"
                        />
                    </IconField>
                    <InputError class="mt-1" :message="form.errors.password" />
                </div>

                <PrimaryBtn
                    block
                    type="submit"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Reset password
                </PrimaryBtn>
            </div>
        </form>
    </AuthLayout>
</template>
