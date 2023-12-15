<script setup>
import { ref } from "vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { useForm, Head } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

let props = defineProps(["user"]);
const form = useForm({
    _method: "put",
    name: props.user.name,
    email: props.user.email,
    age: props.user.age,
    address: props.user.address,
    gender: props.user.gender,
    role: props.user.role,
    avatar: "",
});
const genderItems = ref([
    { value: 1, title: "Male" },
    { value: 2, title: "Female" },
]);
const roleItems = ref([
    { value: 0, title: "User" },
    { value: 1, title: "Admin" },
]);
</script>

<template>
    <Head title="Edit user" />

    <AdminLayout>
        <div class="w-50 mx-auto">
            <form @submit.prevent="form.post(route('users.update', user.id))">
                <v-text-field
                    v-model="form.name"
                    label="Name"
                    variant="underlined"
                    :error="form.errors.name ? true : false"
                    :error-messages="form.errors.name"
                />
                <v-text-field
                    v-model="form.email"
                    label="Email"
                    variant="underlined"
                    :error="form.errors.email ? true : false"
                    :error-messages="form.errors.email"
                />
                <v-text-field
                    v-model="form.age"
                    label="Age"
                    variant="underlined"
                />
                <v-text-field
                    v-model="form.address"
                    label="Address"
                    variant="underlined"
                />
                <v-select
                    v-model="form.gender"
                    item-value="value"
                    variant="underlined"
                    label="Gender"
                    :items="genderItems"
                ></v-select>
                <v-select
                    v-model="form.role"
                    item-value="value"
                    variant="underlined"
                    label="Role"
                    :items="roleItems"
                    :error="form.errors.role ? true : false"
                    :error-messages="form.errors.role"
                ></v-select>
                <v-file-input
                    @input="form.avatar = $event.target.files[0]"
                    clearable
                    variant="underlined"
                    label="Choose avatar"
                ></v-file-input>

                <PrimaryButton class="mt-2 ml-auto">Update</PrimaryButton>
            </form>
        </div>
    </AdminLayout>
</template>
<style></style>
