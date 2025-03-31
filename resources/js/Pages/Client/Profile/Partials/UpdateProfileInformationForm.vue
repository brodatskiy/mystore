<script setup>
import {useForm, usePage} from "@inertiajs/vue3";

import InputError from "@/Components/InputError.vue";

const props = defineProps({
    mustVerifyEmail: Boolean,
    status: String,
});

const user = usePage().props.auth.user;

const form = useForm({
    _method: "patch",
    name: user.name,
    email: user.email,
    avatar: "",
});
</script>

<template>
        <section>
            <header>
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-300">
                    Profile Information
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Update your account's profile information and email address.
                </p>
            </header>

            <form
                @submit.prevent="form.post(route('profile.update'))"
                class="mt-6 space-y-4"
            >
                <div class="flex flex-col gap-1">
                    <label for="name">Username</label>
                    <InputText
                        v-model="form.name"
                        type="name"
                        id="name"
                        autofocus
                        autocomplete="name"
                        class="w-full"
                    />
                    <InputError class="mt-1" :message="form.errors.name"/>
                </div>

                <div class="flex flex-col gap-1">
                    <label for="email">Email</label>
                    <InputText
                        v-model="form.email"
                        type="email"
                        id="email"
                        autocomplete="email"
                        class="w-full"
                    />
                    <InputError :message="form.errors.email"/>
                </div>

                <!-- <div>
                    <label for="avatar">Upload avatar</label>
                    <FileUpload
                        mode="basic"
                        class="mt-1"
                        @input="form.avatar = $event.target.files[0]"
                    />
                </div> -->
                <div
                    v-if="props.mustVerifyEmail && user.email_verified_at === null"
                >
                    <p class="text-sm mt-2 text-gray-800">
                        Your email address is unverified.
                        <Link
                            :href="route('verification.send')"
                            method="post"
                            as="button"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            Click here to re-send the verification email.
                        </Link>
                    </p>

                    <div
                        v-show="props.status === 'verification-link-sent'"
                        class="mt-2 font-medium text-sm text-green-600"
                    >
                        A new verification link has been sent to your email address.
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <Button :disabled="form.processing">Save</Button>

                    <Transition
                        enter-from-class="opacity-0"
                        leave-to-class="opacity-0"
                        class="transition ease-in-out"
                    >
                        <p
                            v-if="form.recentlySuccessful"
                            class="text-sm text-gray-600"
                        >
                            Saved.
                        </p>
                    </Transition>
                </div>
            </form>
        </section>
</template>
