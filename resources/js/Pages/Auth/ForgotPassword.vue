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

                <Btn
                    block
                    type="submit"
                    class="w-full bg-primary-400 hover:bg-primary-500"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Send
                </Btn>
            </div>
        </form>
        <Toast position="bottom-center">
            <span>{{ status }}</span>
        </Toast>
    </AuthLayout>
</template>
