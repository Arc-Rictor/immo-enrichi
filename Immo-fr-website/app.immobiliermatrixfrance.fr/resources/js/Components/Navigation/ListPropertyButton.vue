<template>
    <Link :href="route('listing.create')" class="inline-flex items-center border px-6 bg-orange-500 text-white text-sm md:text-base hover:bg-orange-600 rounded-full h-[55px]"><PlusIcon class="mr-2"  /> {{ __('List a property') }}</Link>
</template>
<script setup>
import {Link} from '@inertiajs/vue3';
import PlusIcon from "@/Components/Icons/PlusIcon.vue";
import { useTranslate} from "@/Composables/useTranslate.js";
const {__} = useTranslate()
</script>
