<template>
    <div>
        <Head title="Immo-Enrichi"/>

        <Banner/>

        <div v-show="mobileSideBarShow" class="inset-0 z-50 flex w-[300px] relative lg:hidden">
            <div class="relative">
                <div class="absolute left-full top-0 flex w-16 justify-center pt-5 z-[100] px-2 py-2.5">
                    <button @click.prevent="mobileSideBarShow = false" type="button" class="-m-2.5 p-2.5">
                        <span class="sr-only">Close sidebar</span>
                        <svg class="h-8 w-8 text-gray-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
            <div class=" fixed top- inset-x-0 w-full bg-white z-50">

                <div class="max-w-xl mx-auto">
                    <Sidebar/>
                </div>
            </div>
            <div @click.prevent="mobileSideBarShow = false" class="fixed inset-0 opacity-25 bg-black z-40"></div>

        </div>
        <div class="min-h-screen relative pt-8 px-8 pb-8">


            <div style="z-index: -999; height: 100%!important;"
                 class=" w-full absolute bottom-0 left-0 bg-no-repeat bg-cover bg-top bg-[url('/images/bg-wide.png')]">
            </div>
            <!-- Mobile -->
            <div class="pb-4 flex lg:hidden">

                <div>
                    <button @click.prevent="mobileSideBarShow = !mobileSideBarShow" type="button"
                            class="-m-2.5 p-2.5 text-gray-700 lg:hidden">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                             aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                        </svg>
                    </button>
                </div>
                <ApplicationLogo class="w-[250px] mx-auto"/>
            </div>

            <!-- Desktop -->
            <div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-[300px] xl:w-[370px] lg:flex-col">
                <Sidebar/>
            </div>
            <!-- Page Content -->
            <main class="py-3 lg:pl-[300px] xl:pl-[370px]">
                <div class="content-container px-4 sm:px-6 lg:px-8 bg-white rounded-3xl overflow-auto">
                    <!-- Top action slot -->
                    <div class="py-7 flex md:hidden justify-between w-full">
                        <div class=" justify-between w-full">
                            <div class="w-full mb-6 inline-flex justify-between">
                                <h1 class="font-bold text-lg md:text-2xl">{{ __('Welcome back') }}, {{
                                        usePage().props.user.first_name
                                    }}!
                                </h1>
                                <div class="flex">
                                    <LanguageSelector/>
                                    <ProfileButton/>
                                </div>
                            </div>
                            <div class="w-full">
                                <slot name="actions">
                                    <div class="w-full flex justify-between gap-6">

                                        <ListPropertyButton v-if="usePage().props.can_list"/>

                                        <SearchButton class="w-[280px]"/>

                                    </div>
                                </slot>
                            </div>
                        </div>
                    </div>
                    <div class="py-7 hidden md:flex justify-between space-x-8">
                        <div class="w-1/2 flex items-center space-x-8">
                            <slot name="actions">

                                <h1 class="font-bold text-lg md:text-2xl">{{ __('Welcome back') }}, {{
                                        usePage().props.user.first_name
                                    }}!</h1>
                                <ListPropertyButton v-if="usePage().props.can_list"/>
                            </slot>
                        </div>

                        <div class="flex items-center space-x-4">
                            <SearchButton class="w-[280px]"/>
                            <!--                            <NotificationButton />-->
                            <LanguageSelector/>
                            <ProfileButton/>
                        </div>
                    </div>
                    <slot/>
                </div>
                <Footer/>

            </main>

        </div>
    </div>
</template>
<script setup>
import {ref} from 'vue';
import {Head, router, usePage} from '@inertiajs/vue3';
import Banner from '@/Components/Banner.vue';
import Sidebar from "@/Components/Navigation/Sidebar.vue";
import ListPropertyButton from "@/Components/Navigation/ListPropertyButton.vue";
import SearchButton from "@/Components/Navigation/SearchButton.vue";
import ProfileButton from "@/Components/Navigation/ProfileButton.vue";
import LanguageSelector from "@/Components/Navigation/LanguageSelector.vue";
import Footer from "@/Components/Footer.vue";
import {useTranslate} from "@/Composables/useTranslate.js";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

const {__} = useTranslate()
defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);
const mobileSideBarShow = ref(false);

const logout = () => {
    router.post(route('logout'));
};
</script>

<style scoped>
.content-container {
    border-radius: 25px;
    box-shadow: 0px -6px 33px 7px rgba(0, 0, 0, 0.06096);
    opacity: 1;
    background-color: rgba(255, 255, 255, 1);
}
</style>
