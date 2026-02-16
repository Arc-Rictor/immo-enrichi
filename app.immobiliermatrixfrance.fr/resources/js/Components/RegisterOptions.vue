<template>
    <RadioGroup class="max-w-4xl mx-auto pt-[100px] " v-model="selectedOption">
        <RadioGroupLabel class="leading-6 text-gray-900 text-3xl">{{
                __('Which account type suits you?')
            }}
        </RadioGroupLabel>
        <div class="mt-20 grid grid-cols-1 content-center gap-y-6 sm:grid-cols-3 sm:gap-x-8">
            <RadioGroupOption as="template" v-for="registerOption in registerOptions" :key="registerOption.id"
                              :value="registerOption" v-slot="{ checked, active }">
                <div
                    class="border-gray-200 relative cursor-not-allowed rounded-xl border bg-white p-4 shadow-sm focus:outline-none']">

                    <template v-if="registerOption.disabled">
                        <span>{{ __("Coming Soon") }}</span>
                        <Link href="#" preserve-scroll class="cursor-not-allowed">
                        <span class="flex flex-col px-8 py-6">
                            <img class="h-[49px] w-[49px] self-center mb-4" :src="registerOption.icon" alt="">
                            <RadioGroupDescription as="span" class="mt-1 flex self-center text-lg">
                                {{ registerOption.description }}
                            </RadioGroupDescription>
                        </span>
                        </Link>
                    </template>

                    <template v-else>
                        <Link :href="registerOption.href" preserve-scroll>
                        <span class="flex flex-col px-8 py-6">
                            <img class="h-[49px] w-[49px] self-center mb-4" :src="registerOption.icon" alt="">
                            <RadioGroupDescription as="span" class="mt-1 flex self-center text-lg">
                                {{ registerOption.description }}
                            </RadioGroupDescription>
                        </span>
                        </Link>
                    </template>
                </div>
            </RadioGroupOption>
        </div>
    </RadioGroup>
</template>

<script setup>
import {ref} from 'vue'
import {RadioGroup, RadioGroupDescription, RadioGroupLabel, RadioGroupOption} from '@headlessui/vue'
import {Link} from '@inertiajs/vue3';
import {useTranslate} from "@/Composables/useTranslate.js";

const {__} = useTranslate();
const registerOptions = [
    {
        id: 1,
        icon: "/images/estate-agent-icon.png",
        title: 'Estate Agent',
        description: __("I'm an estate agent"),
        href: route('register', {type: 'agent'})
    },
    {
        id: 2,
        icon: "/images/buyer-button-icon.png",
        title: 'Seller',
        description: __("I'm a seller"),
        href: route('register', {type: 'seller'})
    },
    {
        id: 3,
        icon: "/images/buyer-button-icon.png",
        disabled: true,
        title: 'Buyer',
        description: __("I'm a buyer"),
        href: route('register', {type: 'buyer'})
    },
]

const selectedOption = ref()
</script>
