<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DungerButton from "@/Components/DangerButton.vue";

defineProps(["user"]);
</script>

<template>
    <Head title="Users" />

    <AdminLayout>
        <div class="mx-auto">
            <div>
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
            <div class="flex">
                <v-img :src="user.avatar" alt="user avatar" class="h-64" />
                <div>
                    <v-table>
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
            </div>
            <v-table fixed-header height="300px" class="mt-6">
                <thead>
                    <tr>
                        <th class="text-left">Avatar</th>
                        <th class="text-left">Name</th>
                        <th class="text-left">Age</th>
                        <th class="text-left">Address</th>
                        <th class="text-left">Gender</th>
                        <th class="text-left">Email</th>
                        <th class="text-left">Role</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <img
                                :src="user.avatar"
                                alt="user avatar"
                                class="object-contain w-full h-32 mb-5"
                            />
                        </td>
                        <td>{{ user.name }}</td>
                        <td>{{ user.age }}</td>
                        <td>{{ user.address }}</td>
                        <td>{{ user.gender }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.role }}</td>
                    </tr>
                </tbody>
            </v-table>
        </div>
    </AdminLayout>
</template>
