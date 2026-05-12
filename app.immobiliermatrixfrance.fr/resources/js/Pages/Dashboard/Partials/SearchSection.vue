<template>
    <div class="h-[275px] border-none rounded-lg w-full p-10 self-center bg-[url('/images/search-bg-dashboard.png')] bg-right bg-cover bg-no-repeat text-white">
        <h2 class="text-3xl font-semibold mb-3">{{ __('Find your perfect home') }}</h2>
        <p class="text-lg">{{ __('Search properties for sale in France') }}</p>
        <div class="w-[366px] mt-6 rounded-lg">
            <SearchButton class="text-gray-900 border-gray-300 bg-white rounded-xl" placeholder="Enter location e.g 'Paris' or '01000' "/>
        </div>
    </div>
</template>
<script setup>
import SearchButton from "@/Components/Navigation/SearchButton.vue";
import { useTranslate} from "@/Composables/useTranslate.js";

const {__} = useTranslate()
</script>
