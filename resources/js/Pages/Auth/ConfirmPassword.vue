<script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";
import { useForm } from "@inertiajs/vue3";

import IconField from "primevue/iconfield";
import InputIcon from "primevue/inputicon";
import InputError from "@/Components/InputError.vue";
import PrimaryBtn from "@/Components/Buttons/PrimaryBtn.vue";

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
            This is a secure area of the application. Please confirm your
            password before continuing.
        </div>

        <form @submit.prevent="submit">
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

            <PrimaryBtn
                block
                type="submit"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Confirm
            </PrimaryBtn>
        </form>
    </AuthLayout>
</template>
