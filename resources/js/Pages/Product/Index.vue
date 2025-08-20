<script setup>
import {Head, router} from "@inertiajs/vue3";
import ShopLayout from "@/Layouts/ShopLayout.vue";
import ButtonPrimary from "@/Components/Buttons/ButtonPrimary.vue";
import {ref} from "vue";

const props = defineProps(["product"]);

const processingAddToWish = ref(false);
const processingAddToCart = ref(false);

function addToCart(product) {
    router.post(route('cart.add', {product: product}), {}, {
        preserveScroll: true,
        async: true,
        onStart: () => {
            processingAddToCart.value = true;
        },
        onFinish: () => {
            processingAddToCart.value = false;
        },
    })
}

function toggleWish(product) {
    router.post(route('wishes.toggle', {product: product}), {}, {
        preserveScroll: true,
        async: true,
        onStart: () => {
            processingAddToWish.value = true;
        },
        onFinish: () => {
            processingAddToWish.value = false;
        },
    });
}
</script>
<template>
    <Head title="Product"/>

    <ShopLayout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-column rounded-lg bg-surface-50 dark:bg-surface-800 p-4 space-x-4">
                <div class="flex-1 relative max-w-72 min-w-52">
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
                    <div class="flex-1 space-y-4">
                        <div><p class="text-2xl font-bold ">{{ product.title }}</p></div>
                        <div class="flex align-">
                            <i class="pi pi-star-fill mt-1"></i>
                            <span class="ml-1"> {{ product.rating }}</span>
                        </div>
                        <p class=" text-xl font-semibold text-gray-600 dark:text-gray-100">{{ product.price }}₽</p>
                        <div class="">
                            {{ product.description }}
                        </div>
                    </div>
                    <div class="flex space-x-4">
                        <ButtonPrimary
                            class="w-full"
                            :class="{ 'opacity-50 ': processingAddToCart } "
                            @click.prevent="addToCart(product)"
                        >
                            {{ $t("Add to cart") }}
                        </ButtonPrimary>
                        <Button severity="secondary" text v-if="$page.props.auth.user"
                                @click.prevent="toggleWish(product)"
                                :class="{ 'opacity-50': processingAddToWish }">
                            <i v-if="product.wished" class="pi pi-heart-fill" style="color: red"></i>
                            <i v-else class="pi pi-heart" style="color: red"></i>
                        </Button>
                    </div>
                </div>
            </div>
            <div class="mt-2">
                <Tag severity="secondary" v-for="tag in product.tags" :value="tag.title" class="mr-2"></Tag>
            </div>
        </div>
    </ShopLayout>
</template>
<style scoped></style>
