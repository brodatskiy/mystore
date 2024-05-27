<script setup>
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import SecondaryBtn from "./Buttons/SecondaryBtn.vue";

defineProps(["product"]);

const processing = ref(false);

function increase(product) {
    router.patch(route("cart.increase", { product: product }), {
        onStart: () => {
            processing.value = true;
        },
        onFinish: () => {
            processing.value = false;
        },
    });
}

function decrease(product) {
    router.patch(route("cart.decrease", { product: product }), {
        onStart: () => {
            processing.value = true;
        },
        onFinish: () => {
            processing.value = false;
        },
    });
}

function destroy(product) {
    router.delete(route("cart.destroy", { product: product }), {
        onStart: () => {
            processing.value = true;
        },
        onFinish: () => {
            processing.value = false;
        },
    });
}
</script>
<template>
    <div class="mb-6 rounded-lg bg-white p-4 shadow-md flex">
        <Link :href="route('product.show', product)">
            <img
                :src="product.image"
                alt="Card Image"
                class="w-full rounded-lg sm:w-40"
            />
        </Link>
        <div class="flex justify-between w-full px-4">
            <div class="flex flex-col">
                <div class="flex-1">
                    <Link :href="route('product.show', product)">
                        <h2 class="text-lg font-bold text-gray-900">
                            {{ product.title }}
                        </h2>
                    </Link>
                    <p class="mt-1 text-xs text-gray-700">
                        {{ product.description }}
                    </p>
                </div>
                <div class="flex space-x-2">
                    <SecondaryBtn>
                        <Icon icon="mdi:heart-outline" class="h-5 w-5 m-2" />
                    </SecondaryBtn>
                    <SecondaryBtn @click="destroy(product)">
                        <Icon icon="mdi:trash-outline" class="h-5 w-5 m-2" />
                    </SecondaryBtn>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <div class="">
                    <p class="text-center">
                        ${{ product.price * product.quantity }}
                    </p>
                </div>
                <div class="flex">
                    <button
                        class="rounded-l-md bg-primary-300 hover:bg-primary-400 active:bg-primary-500 px-3 py-2"
                        @click="decrease(product)"
                    >
                        -
                    </button>
                    <button class="hover:bg-gray-100 px-3 py-2">
                        {{ product.quantity }}
                    </button>
                    <button
                        class="rounded-r-md bg-primary-300 hover:bg-primary-400 active:bg-primary-500 px-3 py-2"
                        @click="increase(product)"
                    >
                        +
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
