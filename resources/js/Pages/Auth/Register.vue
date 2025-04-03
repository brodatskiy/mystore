<script setup>
import {ref} from "vue";
import AuthLayout from "@/Layouts/AuthLayout.vue";
import {Head, Link, useForm} from "@inertiajs/vue3";

import IconField from "primevue/iconfield";
import InputIcon from "primevue/inputicon";
import InputError from "@/Components/InputError.vue";
import ButtonPrimary from "@/Components/Buttons/ButtonPrimary.vue";

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
    <AuthLayout>
        <Head title="Register"/>

        <form @submit.prevent="submit">
            <div class="flex flex-col gap-3">
                <div>
                    <IconField iconPosition="left">
                        <InputIcon>
                            <i class="pi pi-user -mt-1"></i>
                        </InputIcon>

                        <InputText
                            v-model="form.name"
                            id="name"
                            type="name"
                            placeholder="Name"
                            class="pl-10 w-full"
                        />
                    </IconField>
                    <InputError class="mt-1" :message="form.errors.name"/>
                </div>
                <div>
                    <IconField iconPosition="left">
                        <InputIcon>
                            <i class="pi pi-at -mt-1"></i>
                        </InputIcon>

                        <InputText
                            v-model="form.email"
                            id="email"
                            type="email"
                            placeholder="Email"
                            class="pl-10 w-full"
                        />
                    </IconField>
                    <InputError class="mt-1" :message="form.errors.email"/>
                </div>

                <div>
                    <IconField iconPosition="left">
                        <InputIcon>
                            <i class="pi pi-unlock -mt-1"></i>
                        </InputIcon>
                        <InputText
                            v-model="form.password"
                            type="password"
                            placeholder="Password"
                            class="pl-10 w-full"
                        />
                    </IconField>
                    <InputError class="mt-1" :message="form.errors.password"/>
                </div>

                <div>
                    <IconField iconPosition="left">
                        <InputIcon>
                            <i class="pi pi-unlock -mt-1"></i>
                        </InputIcon>
                        <InputText
                            v-model="form.password_confirmation"
                            type="password"
                            placeholder="Password"
                            class="pl-10 w-full"
                        />
                    </IconField>
                    <InputError class="mt-1" :message="form.errors.password"/>
                </div>

                <ButtonPrimary
                    block
                    type="submit"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Register
                </ButtonPrimary>

                <Link :href="route('login')"
                      class="text-primary-600 dark:text-primary-300 hover:text-primary-500 dark:hover:text-primary-400">
                    <p>Already registered?</p>
                </Link>
            </div>
        </form>
    </AuthLayout>
</template>
