<template>
    <div class="ml-3 relative">
        <Dropdown align="right" width="48">
            <template #trigger>
                <button v-if="$page.props.jetstream.managesProfilePhotos"
                        class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                    <img class="h-[30px] w-[30px] md:h-[55px] md:w-[55px] rounded-full object-cover"
                         :src="$page.props.auth.user.profile_photo_url"
                         :alt="$page.props.auth.user.first_name + ' ' + $page.props.auth.user.last_name">
                </button>

                <span v-else class="inline-flex rounded-md">
                                            <button type="button"
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                                {{
                                                    $page.props.auth.user.first_name
                                                }} {{ $page.props.auth.user.last_name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                     fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                     stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                                </svg>
                                            </button>
                                        </span>
            </template>

            <template #content>
                <!-- Account Management -->
                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Manage Account')}}
                </div>

                <DropdownLink :href="route('profile.show')">
                    {{ __('My Account')}}
                </DropdownLink>
                <a :href="route('billing')" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                    {{ __('Manage Subscription')}}
                </a>



                <div class="border-t border-gray-200"/>

                <!-- Authentication -->
                <form @submit.prevent="logout">
                    <DropdownLink as="button">
                        {{ __('Log Out')}}
                    </DropdownLink>
                </form>
            </template>
        </Dropdown>
    </div>
</template>
<script setup>
import DropdownLink from "@/Components/DropdownLink.vue";
import Dropdown from "@/Components/Dropdown.vue";
import {router, Link} from "@inertiajs/vue3";
import {useTranslate} from "@/Composables/useTranslate.js";
const {__} = useTranslate()

const logout = () => {
    router.post(route('logout'));
};


</script>
