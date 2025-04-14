<script setup>
import {ref} from "vue";
import {Link, router} from "@inertiajs/vue3";
import Button from "primevue/button";
import ButtonPrimary from "@/Components/Buttons/ButtonPrimary.vue";

defineProps(["product"]);

const processingAddToWish = ref(false);
const processingAddToCart = ref(false);

function destroy(product) {
    router.delete(route("cart.destroy", {product: product}), {
        onStart: () => {
            processing.value = true;
        },
        onFinish: () => {
            processing.value = false;
        },
    });
}

function addToCart(product) {
    router.post(route('cart.add', {product: product}), {}, {
        preserveScroll: true,
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
        onStart: () => {
            processingAddToWish.value = true;
        },
        onFinish: () => {
            processingAddToWish.value = false;
        },
    });

    router.reload({only: ['product']})
}
</script>
<template>
    <div class="flex mb-4 rounded-lg bg-surface-50 dark:bg-surface-600 p-4 shadow-md text-black dark:text-white">
        <Link :href="route('product.show', product)">
            <img
                :src="product.image"
                alt="Card Image"
                class="w-full rounded-lg sm:w-40"
            />
        </Link>
        <div class="flex justify-between w-full px-4">
            <div class="flex flex-col w-2/3 space-y-2">
                <div class="flex-1">
                    <Link :href="route('product.show', product)">
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white">
                            {{ product.title }}
                        </h2>
                    </Link>
                    <p class="mt-1 text-xs text-gray-700 dark:text-gray-200">
                        {{ product.description }}
                    </p>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <ButtonPrimary
                    class="w-full"
                    :class="{ 'opacity-50': processingAddToCart }"
                    @click.prevent="addToCart(product)"
                >
                    {{ $t("Add to cart") }}
                </ButtonPrimary>
                <Button severity="secondary" text v-if="$page.props.auth.user" @click.prevent="toggleWish(product)"
                        :class="{ 'opacity-50': processingAddToWish }">
                    <i v-if="product.wished" class="pi pi-heart-fill" style="color: red"></i>
                    <i v-else class="pi pi-heart" style="color: red"></i>
                </Button>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
