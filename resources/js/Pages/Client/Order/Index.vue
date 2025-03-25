<script setup>
import {Head} from "@inertiajs/vue3";
import OrderCard from "@/Components/OrderCard.vue";
import ShopLayout from "@/Layouts/ShopLayout.vue";

const props = defineProps({
    orders: Object,
});
</script>
<template>
    <Head title="Orders" />
    <ShopLayout>
        <template #header>
            {{ $t("Orders") }}
        </template>

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
