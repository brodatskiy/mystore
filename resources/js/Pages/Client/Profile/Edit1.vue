<script setup>
import { ref } from "vue";
import { useForm, usePage } from "@inertiajs/vue3";

import ShopLayout from "@/Layouts/ShopLayout.vue";
import Btn from "@/Components/Btn.vue";

import InputNumber from "primevue/inputnumber";
import InputError from "@/Components/InputError.vue";

let props = defineProps({
    mustVerifyEmail: Boolean,
    status: String,
});

const user = usePage().props.auth.user;

const form = useForm({
    _method: "patch",
    name: user.name,
    email: user.email,
    age: user.age,
    address: user.address,
    gender: user.gender,
    role: user.role,
    avatar: "",
});

const genderItems = ref([
    { value: 1, title: "Male" },
    { value: 2, title: "Female" },
]);
</script>

<template>
    <Head title="Profile" />

    <ShopLayout>
        <div
            class="flex flex-col items-center px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"
        >
            <h2 class="text-center mt-2">Profile</h2>
            <div class="w-1/2 pa-4 mt-2">
                <form
                    @submit.prevent="
                        form.post(route('profile.update', user.id))
                    "
                >
                    <div class="flex flex-col items-center gap-3">
                        <div class="flex flex-col gap-1">
                            <label for="name">Username</label>
                            <InputText
                                v-model="form.name"
                                type="name"
                                id="name"
                                autofocus
                                class="w-[17rem]"
                            />
                            <InputError :message="form.errors.name" />
                        </div>

                        <div class="flex flex-col gap-1">
                            <label for="email">Email</label>
                            <InputText
                                v-model="form.email"
                                type="email"
                                id="email"
                                class="w-[17rem]"
                            />
                            <InputError :message="form.errors.email" />
                        </div>

                        <div class="flex flex-col gap-1">
                            <label for="age">Age</label>
                            <InputNumber
                                v-model="form.age"
                                inputId="age"
                                :useGrouping="false"
                                class="w-[17rem]"
                            />
                            <InputError :message="form.errors.age" />
                        </div>

                        <div class="flex flex-col gap-1">
                            <label for="address">Address</label>
                            <InputText
                                v-model="form.address"
                                class="w-[17rem]"
                            />
                            <InputError :message="form.errors.address" />
                        </div>

                        <div class="flex flex-col gap-1">
                            <label for="name">Gender</label>
                            <Dropdown
                                v-model="form.gender"
                                :options="genderItems"
                                optionLabel="title"
                                optionValue="value"
                                placeholder="Select a gender"
                                class="w-[17rem]"
                            />
                            <InputError :message="form.errors.gender" />
                        </div>

                        <div class="flex flex-col gap-1">
                            <label for="avatar">Upload avatar</label>
                            <FileUpload
                                mode="basic"
                                class="mt-1"
                                @input="form.avatar = $event.target.files[0]"
                            />

                            <Button class="font-bold mt-2" type="submit">
                                Update
                            </Button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </ShopLayout>
</template>
<style></style>
