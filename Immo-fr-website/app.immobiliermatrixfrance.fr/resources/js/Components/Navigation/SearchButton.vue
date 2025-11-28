<template>
    <div class="relative rounded-md ">
        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
            <SearchIcon class="h-4 w-4 text-gray-400" aria-hidden="true" />
        </div>
        <LocationSearchInput border="h-[50px] w-full border-0 focus:border-0 focus:ring-0 bg-white" @keyup.enter="submit" v-model="search.location" type="text" class="p-0 bg-transparent pl-10 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl" :placeholder="__(placeholder)"/>

    </div>
</template>
<script setup>
import SearchIcon from "@/Components/Icons/SearchIcon.vue";
import {router, useForm} from "@inertiajs/vue3";
import {ref} from "vue";
import LocationSearchInput from "@/Pages/Search/partials/LocationSearchInput.vue";
import { useTranslate} from "@/Composables/useTranslate.js";
const {__} = useTranslate()
defineProps({
    placeholder: {
        default: 'Search a location'
    },
    width: {
        default: '280px'
    }
})

const search = ref({
    location: '',
    radius: 10,
})

const submit = () => {
    router.visit(route('property-search', search.value))
}
</script>
