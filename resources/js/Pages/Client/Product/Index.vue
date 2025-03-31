<script setup>
import {router, Head} from "@inertiajs/vue3";
import ShopLayout from "@/Layouts/ShopLayout.vue";

const props = defineProps(["product"]);

function add(product) {
    router.post(route('cart.add', {product: product}))
}

function toggleWish(product) {
    router.post(route('wish.toggle', {product: product}))
}
</script>
<template>
    <Head title="Product"/>

    <ShopLayout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex flex-column rounded-lg bg-surface-50 dark:bg-surface-800 p-4 space-x-4">
                <div class="flex-1 relative">
                    <img
                        class="w-full rounded-lg object-cover object-center"
                        :src="product.image"
                        :alt="product.title"
                    >
                    <div v-if="product.sticker" class="absolute top-2 right-2 text-white">
                        {{ product.sticker.title.toUpperCase() }}
                    </div>
                </div>

                <div class="flex flex-col">
                    <div class="space-y-4">
                        <p class="text-2xl font-bold ">{{ product.title }}</p>
                        <p class=" text-xl font-semibold text-gray-600 dark:text-gray-100">${{ product.price }}</p>
                        <div class="mb-2">
                            {{ product.description }}
                        </div>
                    </div>
                    <div class="mt-auto">
                        <Button
                            class=" w-50"
                            @click="add(product)"
                        >
                            Add to cart
                        </Button>
                        <pre>
                            {{ product }}
                        </pre>
                        <Button severity="secondary" v-if="$page.props.auth.user" @click.prevent="toggleWish(product)">
                            <i v-if="product.wished" class="pi pi-heart-fill" style="color: red"></i>
                            <i v-else class="pi pi-heart" style="color: red"></i>
                        </Button>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <Chip v-for="tag in product.tags" class="mr-2">{{
                        tag.title
                    }}
                </Chip>
            </div>
        </div>
    </ShopLayout>
</template>
<style scoped></style>
