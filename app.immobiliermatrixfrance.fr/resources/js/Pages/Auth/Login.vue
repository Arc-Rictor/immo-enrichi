<template>
    <Head title="Register"/>
    <div class="flex">
        <div
            class="hidden md:block md:w-[300px] lg:w-[500px] relative min-h-screen shrink-0 h-screen bg-[#FFA163] bg-[url('/images/login-bg.png')] bg-no-repeat bg-cover">
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
        <div class="py-6 px-8 w-full min-h-screen">
            <!-- login -->
            <div class="flex justify-end space-x-6">
                <div class="flex" style="align-items: center">
                    <LanguageSelector class="self-center" />
                </div>

                <span class="self-center">{{ __("Don't have an account?") }}</span>
                <Link class="border border-gray-700 py-4 w-[141px] h-[55px] px-10 rounded-3xl font-semibold"
                      href="/register">{{ __('Register') }}
                </Link>
            </div>

            <!-- content -->
            <div class="w-full h-full text-center content-center">
                <div class="mx-auto w-1/2 p-4 my-10 block md:hidden">
                    <ApplicationLogo/>
                </div>
                <!-- user registration form -->
                <form @submit.prevent="submit">
                    <div class="md:w-[550px] mx-auto md:pt-[200px]">
                        <h1 class="leading-6 text-gray-900 text-3xl">{{ __('Log in to your account') }}</h1>
                        <div class="text-left mt-10 space-y-6">

                            <div>
                                <InputLabel class="mt-2" for="email" :value="__('Email address')"/>
                                <TextInput
                                    id="email"
                                    v-model="form.email"
                                    type="email"
                                    class="mt-1 h-[65px] block w-full"
                                    required
                                    autofocus
                                    autocomplete="email"
                                />
                                <InputError class="mt-2 text-right" :message="form.errors.email"/>
                            </div>
                            <div>
                                <InputLabel class="mt-2" for="password" :value="__('Password')"/>
                                <TextInput
                                    id="password"
                                    v-model="form.password"
                                    type="password"
                                    class="mt-1 h-[65px] block w-full"
                                    required
                                    autofocus
                                    autocomplete="password"
                                />
                                <InputError class="mt-2" :message="form.errors.password"/>
                            </div>

                            <div class="text-center pt-8">
                                <PrimaryButton>{{ __('Sign in') }}</PrimaryButton>
                            </div>
                            <div class="text-center">
                                <Link class="underline text-gray-600 text-sm" :href="route('password.request')">
                                    {{ __('Forgotten password?') }}
                                </Link>
                            </div>

                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>


</template>
<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import {useTranslate} from "@/Composables/useTranslate.js";
import LanguageSelector from "@/Components/Navigation/LanguageSelector.vue";

const form = useForm({
    email: '',
    password: '',
});
const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};

const {__} = useTranslate()

</script>
