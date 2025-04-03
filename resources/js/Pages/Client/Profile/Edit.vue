<script setup>
import {Head} from "@inertiajs/vue3";
import ShopLayout from "@/Layouts/ShopLayout.vue";
import DeleteUserForm from "./Partials/DeleteUserForm.vue";
import UpdatePasswordForm from "./Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "./Partials/UpdateProfileInformationForm.vue";

defineProps({
    mustVerifyEmail: Boolean,
    status: String,
});
</script>

<template>
    <Head title="Profile"/>

    <ShopLayout>
        <template #header>
            {{ $t("Profile") }}
        </template>

        <div class="">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-surface-50 dark:bg-surface-800 dark:text-white shadow sm:rounded-lg">
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class="max-w-xl"
                    />
                </div>

                <div class="p-4 sm:p-8 bg-surface-50 dark:bg-surface-800 dark:text-white shadow sm:rounded-lg">
                    <UpdatePasswordForm class="max-w-xl"/>
                </div>

                <div class="p-4 sm:p-8 bg-surface-50 dark:bg-surface-800 dark:text-white shadow sm:rounded-lg">
                    <DeleteUserForm class="max-w-xl"/>
                </div>
            </div>
        </div>
    </ShopLayout>
</template>
