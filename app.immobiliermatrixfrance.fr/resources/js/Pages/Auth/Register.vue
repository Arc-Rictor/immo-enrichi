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
            <!-- login -->
            <div class="flex justify-end space-x-6">
                <div class="flex" style="align-items: center">
                    <LanguageSelector class="self-center" />
                </div>
                <span class="self-center">{{ __('Already have an account?') }}</span>
                <Link class="border border-gray-700 py-4 min-w-[141px] h-[55px] px-12 rounded-3xl font-semibold"
                      href="/login">{{ __('Login') }}
                </Link>
            </div>

            <!-- content -->
            <div class="w-full h-full text-center content-center">
                <div class="mx-auto w-1/2 my-4 p-4">
                    <ApplicationLogo/>
                </div>
                <!-- Select account type -->
                <RegisterOptions v-if="!typeSelected"/>
                <!-- user registration form -->
                <form @submit.prevent="submit" v-if="typeSelected">
                    <div class="w-[550px] mx-auto pt-[100px]">
                        <h1 class="leading-6 text-gray-900 text-3xl">{{ __('Register') }}</h1>
                        <div class="text-left mt-10 space-y-6">
                            <div>
                                <InputLabel for="first_name" :value="__('First name')"/>
                                <TextInput
                                    id="first_name"
                                    v-model="form.first_name"
                                    type="text"
                                    class="mt-1 h-[65px] block w-full"
                                    required
                                    autofocus
                                    autocomplete="first_name"
                                />
                                <InputError :message="form.errors.first_name"/>
                            </div>
                            <div>
                                <InputLabel class="mt-2" for="last_name" :value="__('Last name')"/>
                                <TextInput
                                    id="last_name"
                                    v-model="form.last_name"
                                    type="text"
                                    class="mt-1 h-[65px] block w-full"
                                    required
                                    autofocus
                                    autocomplete="last_name"
                                />
                                <InputError class="mt-2" :message="form.errors.last_name"/>
                            </div>
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
                                <InputError v-show="form.password.length > 0 && !isPasswordValid" class="mt-2" :message="__('Password must be at least 8 characters.')"/>


                            </div>
                            <div>
                                <InputLabel class="mt-2" for="password_confirmation" :value="__('Confirm Password')"/>
                                <TextInput
                                    id="password_confirmation"
                                    v-model="form.password_confirmation"
                                    type="password"
                                    class="mt-1 h-[65px] block w-full"
                                    required
                                    autofocus
                                    autocomplete="password_confirmation"
                                />
                                <InputError class="mt-2" :message="form.errors.password_confirmation"/>

                                <InputError v-show="form.password_confirmation.length > 0 && !isConfirmPasswordValid" class="mt-2" :message="__('Password must be at least 8 characters.')"/>


                            </div>
                            <div class="text-center pt-8">
                                <PrimaryButton :disabled="!isPasswordValid || !isConfirmPasswordValid">{{ __('Create an account') }}</PrimaryButton>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>


</template>
<script setup>
import {Head, Link, useForm, usePage} from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import RegisterOptions from "@/Components/RegisterOptions.vue";
import {computed, ref} from "vue";
import {useTranslate} from "@/Composables/useTranslate.js";
import LanguageSelector from "@/Components/Navigation/LanguageSelector.vue";

const {__} = useTranslate()
const typeSelected = ref(new URLSearchParams(window.location.search).get('type'))

const form = useForm({
    first_name: '',
    last_name: '',
    email: '',
    password: '',
    password_confirmation: '',
    type: typeSelected.value ?? ''
});

const isPasswordValid = computed(() => form.password.length >= 8)
let isConfirmPasswordValid = computed(() => form.password_confirmation.length >= 8)

const submit = () => {
    form.post(route('register'), {
        onFinish: () => {
            form.reset('password', 'password_confirmation')
            window.location = '/dashboard'
        }
    });
};
</script>
