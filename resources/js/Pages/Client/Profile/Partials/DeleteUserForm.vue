<script setup>
import { useForm } from "@inertiajs/vue3";
import { nextTick, ref } from "vue";

import DangerBtn from "@/Components/Buttons/DangerBtn.vue";
import IconField from "primevue/iconfield";
import InputIcon from "primevue/inputicon";
import InputError from "@/Components/InputError.vue";
import SecondaryBtn from "@/Components/Buttons/SecondaryBtn.vue";

import Dialog from "primevue/dialog";

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: "",
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;
};

const deleteUser = () => {
    form.delete(route("profile.destroy"), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
};
</script>

<template>
    <section class="space-y-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900">Delete Account</h2>

            <p class="mt-1 text-sm text-gray-600">
                Once your account is deleted, all of its resources and data will
                be permanently deleted. Before deleting your account, please
                download any data or information that you wish to retain.
            </p>
        </header>

        {{ console.log(passwordInput) }}
        <DangerBtn @click="confirmUserDeletion">Delete Account</DangerBtn>

        <Dialog :visible="confirmingUserDeletion" modal header="Delete Profile">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    Are you sure you want to delete your account?
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    Once your account is deleted, all of its resources and data
                    will be permanently deleted. Please enter your password to
                    confirm you would like to permanently delete your account.
                </p>

                <div class="mt-6">
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
                            id="password"
                            autofocus
                            ref="passwordInput"
                            placeholder="Password"
                            class="pl-10 w-full"
                        />
                    </IconField>
                    <InputError class="mt-1" :message="form.errors.password" />
                </div>

                <div class="mt-6 flex justify-end">
                    <SecondaryBtn @click="closeModal"> Cancel </SecondaryBtn>

                    <DangerBtn
                        class="ml-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteUser"
                    >
                        Delete Account
                    </DangerBtn>
                </div>
            </div>
        </Dialog>
    </section>
</template>
