<template>
    <div>
        <div class="sm:hidden">
            <label for="tabs" class="sr-only">Select a tab</label>
            <select id="tabs" name="tabs" v-model="active" @change="active = $event.target.value; $emit('update', $event.target.value)"
                    class="block w-full rounded-md border-gray-300 focus:border-gray-500 focus:ring-gray-500">
                <option v-for="tab in tabs" :key="tab.name" :selected="tab.name === active">{{ tab.name }}</option>
            </select>
        </div>

        <div class="hidden sm:block">
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex" aria-label="Tabs">
                    <a v-for="tab in tabs" :key="tab.name" :href="tab.href"
                       @click.prevent="active = tab.name; $emit('update', tab.name)"
                       :class="[tab.name === active ? 'border-gray-500 text-gray-900' : 'border-transparent text-gray-900 hover:border-gray-300 hover:text-gray-700', 'w-1/3 border-b py-4 px-1 text-center font-medium']"
                       :aria-current="tab.name === active ? 'page' : undefined">{{ tab.name }}</a>
                </nav>
            </div>
        </div>
        <slot />
    </div>
</template>
<script setup>

import {ref} from "vue";

const props = defineProps({
    activeTab: {
        required: true,
    },
    tabs: {
        required: true,
    }

})

let active = ref(props.activeTab)
</script>
