<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, router } from "@inertiajs/vue3";
</script>
<template>
    <Head title="Dashboard" />
    <AdminLayout>
        <h1 class="mb-8 text-3xl font-bold">Dashboard</h1>

        <p>{{ $page.props.auth.user.name }}</p>
    </AdminLayout>
</template>
