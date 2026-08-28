<!--
    Preview-only entry screen.

    This reproduces the application's own account-type screen: the frame comes
    from Pages/Auth/Register.vue and the option cards from
    Components/RegisterOptions.vue, using the same markup, classes, icons and
    translation keys. Nothing here is a new design.

    It differs from the real screen in exactly two ways, both required so the
    client can review every perspective:
      - the buyer card is selectable (the real one is marked "Coming Soon"),
      - an administrator card is added.
    Selecting a card sets the preview persona instead of starting registration.
-->
<template>
    <Head :title="__('Register')"/>
    <div class="flex relative">
        <div
            class="hidden md:block md:w-1/4 relative min-h-screen  h-screen bg-[#FFA163] bg-[url('/images/background-01.png')] bg-no-repeat bg-cover">
            <div class="mx-auto w-3/4 p-4">
                <ApplicationLogo/>
            </div>
            <div class="p-8 absolute bottom-0 left-0">
                <div class="p-10 rounded-xl bg-black text-white">
                    <p class="text-[18px] ">
                        “ J'ai pu chercher une nouvelle maison et mettre en vente ma propriété actuelle en gardant un œil sur toutes les opérations sur une seule et même plateforme !
                        ”
                    </p>
                    <p class="font-bold text-sm mt-3">Richard Black</p>
                    <p class="text-sm">Paris, France</p>
                </div>
            </div>
        </div>
        <div class="py-6 px-8 w-full min-h-screen md:w-3/4">
            <div class="flex justify-end space-x-6">
                <div class="flex" style="align-items: center">
                    <LanguageSelector class="self-center"/>
                </div>
            </div>

            <div class="w-full h-full text-center content-center">
                <div class="mx-auto w-1/2 my-4 p-4">
                    <ApplicationLogo/>
                </div>

                <div class="max-w-4xl mx-auto pt-[100px]">
                    <h1 class="leading-6 text-gray-900 text-3xl">
                        {{ __('Which account type suits you?') }}
                    </h1>
                    <div class="mt-20 grid grid-cols-1 content-center gap-y-6 sm:grid-cols-2 lg:grid-cols-4 sm:gap-x-8">
                        <button v-for="option in options" :key="option.type"
                                type="button"
                                @click="$emit('choose', option.type)"
                                class="border-gray-200 relative cursor-pointer rounded-xl border bg-white p-4 shadow-sm transition hover:border-gray-500 focus:outline-none">
                            <span class="flex flex-col px-8 py-6">
                                <img v-if="option.icon"
                                     class="h-[49px] w-[49px] self-center mb-4"
                                     :src="option.icon" alt="">
                                <UserGroupIcon v-else class="h-[49px] w-[49px] self-center mb-4 text-gray-900"/>
                                <span class="mt-1 flex self-center text-lg">
                                    {{ __(option.description) }}
                                </span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import {Head} from '@inertiajs/vue3';
import {UserGroupIcon} from "@heroicons/vue/24/outline/index.js";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import LanguageSelector from "@/Components/Navigation/LanguageSelector.vue";
import {useTranslate} from "@/Composables/useTranslate.js";

defineEmits(['choose']);

const {__} = useTranslate();

// Same icons and description keys as Components/RegisterOptions.vue.
const options = [
    {type: 'agent', icon: '/images/estate-agent-icon.png', description: "I'm an estate agent"},
    {type: 'seller', icon: '/images/buyer-button-icon.png', description: "I'm a seller"},
    {type: 'buyer', icon: '/images/buyer-button-icon.png', description: "I'm a buyer"},
    {type: 'admin', icon: null, description: "I'm an administrator"},
];
</script>
