<script setup>
import {router} from "@inertiajs/vue3";
import {Link} from "@inertiajs/vue3";
import ButtonPrimary from "@/Components/Buttons/ButtonPrimary.vue";

defineProps(["product"]);

function add(product) {
    router.post(route('cart.add', {product: product}))
}

function toggleWish(product) {
    router.post(route('wish.toggle', {product: product}))
}
</script>
<template>
    <Link :href="route('product.show', product) ">
        <div
            class="max-w-72 min-w-52 cursor-pointer rounded-lg bg-surface-100 dark:bg-surface-800 p-2 shadow duration-150 hover:scale-105 hover:shadow-md">
            <div class="relative">
                <div v-if="!product.image" class="w-full h-72 bg-gray-300 rounded"></div>
                <img v-else class="w-full h-72 rounded-lg object-cover object-center" :src="product.image"
                     :alt="product.title">
                <p v-if="product.sticker" class="absolute top-2 right-2">
                    {{ product.sticker.title.toUpperCase() }}
                </p>
            </div>
            <div class="flex items-center justify-between py-2">
                <p class=" text-l font-semibold text-surface-800 dark:text-surface-200">${{ product.price }}</p>
                <Button severity="secondary" text v-if="$page.props.auth.user" @click.prevent="toggleWish(product)">
                    <i v-if="product.wished" class="pi pi-heart-fill" style="color: red"></i>
                    <i v-else class="pi pi-heart" style="color: red"></i>
                </Button>
            </div>
            <ButtonPrimary
                class="w-full"
                @click.prevent="add(product)"
            >
                {{ $t("Add to cart") }}
            </ButtonPrimary>
        </div>
    </Link>
</template>
<style scoped></style>
