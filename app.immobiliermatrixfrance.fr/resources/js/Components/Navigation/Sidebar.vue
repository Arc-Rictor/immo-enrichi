<template>
    <div class="px-6 py-8">
        <ApplicationLogo class="w-[250px] mx-auto"/>

        <!-- Nav links -->
        <div class="w-full mt-10 space-y-4">
            <NavLink :active="route().current('dashboard')" href="/dashboard">
                {{ __('Dashboard') }}
                <template #icon>
                    <DashboardIcon class="h-4 w-4" />
                </template>
            </NavLink>
            <NavLink :active="route().current('property-search')" :href="route('property-search')">
                {{ __('Property Search') }}
                <template #icon>
                    <HouseIcon  class="h-4 w-4"/>
                </template>
            </NavLink>
            <NavLink v-if="usePage().props.user.type !== 'buyer'" :active="route().current('listing.*')" :href="route('listing.index')">
                {{ __('My Properties') }}
                <template #icon>
                    <HomeIcon  class="h-4 w-4"/>
                </template>
            </NavLink>
            <a  href="https://www.platformstaging.co.uk/imf/fr#faqs" class="group inline-flex h-[60px] justify-between w-full items-center gap-x-2 text-lg rounded-full bg-transparent px-5 py-2.5 font-medium hover:text-white hover:bg-black focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600;
">
                {{ __('Support/FAQs') }}
                <span class="p-3 group-hover:bg-white rounded-full">
                    <FaqIcon  class="h-4 w-4 "/>
                </span>
            </a>
            <NavLink v-if="usePage().props.user.type === 'admin'" :active="route().current('admin.users.*')" :href="route('admin.users.index')">
                {{ __('Users') }}
                <template #icon>
                    <UserGroupIcon  class="h-4 w-4 group-hover:text-gray-900"/>
                </template>
            </NavLink>
        </div>
    </div>
</template>
<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import NavLink from "@/Components/NavLink.vue";
import DashboardIcon from "@/Components/Icons/DashboardIcon.vue";
import HouseIcon from "@/Components/Icons/HouseIcon.vue";
import HomeIcon from "@/Components/Icons/HomeIcon.vue";
import FaqIcon from "@/Components/Icons/FaqIcon.vue";
import {UserGroupIcon} from "@heroicons/vue/24/outline/index.js";

import { useTranslate } from "@/Composables/useTranslate.js";
import {usePage} from "@inertiajs/vue3";

const {__} = useTranslate()
</script>
