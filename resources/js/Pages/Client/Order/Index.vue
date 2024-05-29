<script setup>
import OrderCard from "@/Components/OrderCard.vue";
import ShopLayout from "@/Layouts/ShopLayout.vue";

const props = defineProps({
    orders: Object,
});
</script>
<template>
    <Head title="Orders" />
    <ShopLayout>
        <h1 class="mb-6 text-center text-2xl font-bold">Orders</h1>
        <div
            class="mx-auto max-w-5xl justify-center px-6 md:flex md:space-x-6 xl:px-0"
        >
            <div class="w-full">
                <OrderCard
                    v-for="order in props.orders"
                    :key="order.id"
                    :order="order"
                ></OrderCard>
            </div>
        </div>
    </ShopLayout>
</template>

<style scoped></style>
