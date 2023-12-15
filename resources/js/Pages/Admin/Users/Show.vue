<script setup>
import { ref } from "vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/Admin/PrimaryButton.vue";
import DungerButton from "@/Components/Admin/DangerButton.vue";

import AvatarPlaceholder from "~/assets/images/avatar-placeholder.png";

const props = defineProps(["user"]);

const breadcrumbs = ref([
    { title: "Dashboard", disabled: false, href: "dashboard.index" },
    { title: "Users", disabled: false, href: "users.index" },
    {
        title: props.user.id,
        disabled: true,
        href: "users.index",
    },
]);
</script>

<template>
    <Head title="Users" />

    <AdminLayout>
        <div>
            <v-breadcrumbs :items="breadcrumbs">
                <template v-slot:title="{ item }">
                    <Link :href="route(item.href)">
                        {{ item.title }}
                    </Link>
                </template>
                <template v-slot:divider>
                    <v-icon icon="mdi-chevron-right"></v-icon>
                </template>
            </v-breadcrumbs>
        </div>
        <v-sheet class="pa-2" rounded="xl" elevation="3">
            <div class="d-flex flex-row justify-left mt-4">
                <div>
                    <v-img
                        v-if="user.avatar"
                        :src="user.avatar"
                        alt="user avatar"
                        class="w-full"
                    />
                    <v-img
                        v-else
                        :width="200"
                        aspect-ratio="1/1"
                        :src="AvatarPlaceholder"
                        alt="user avatar"
                        class="w-full"
                    />
                </div>

                <v-table class="ml-4">
                    <tbody>
                        <tr>
                            <td>Name</td>
                            <td>{{ user.name }}</td>
                        </tr>
                        <tr>
                            <td>Age</td>
                            <td>{{ user.age }}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>{{ user.address }}</td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td>{{ user.gender }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ user.email }}</td>
                        </tr>
                        <tr>
                            <td>Role</td>
                            <td>{{ user.role }}</td>
                        </tr>
                    </tbody>
                </v-table>
            </div>
            <div class="px-4">
                <PrimaryButton :href="route('users.edit', user.id)" as="button">
                    Edit
                </PrimaryButton>
                <DungerButton
                    :href="route('users.destroy', user.id)"
                    class="ml-2"
                    method="delete"
                    as="button"
                >
                    Delete
                </DungerButton>
            </div>
        </v-sheet>
    </AdminLayout>
</template>
