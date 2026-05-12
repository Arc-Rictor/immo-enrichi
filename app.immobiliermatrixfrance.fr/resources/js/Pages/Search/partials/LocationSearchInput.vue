<template>
    <div class="search-container">
        <TextInput
            :height="props.border"
            type="text"
            v-model="search"
            @input="updateInput"
            @keydown.up.prevent="decrementActiveIndex"
            @keydown.down.prevent="incrementActiveIndex"
            @keydown.enter.prevent="selectLocation"
            :placeholder="__('Search location...')"
            tabindex="0"
        />
        <ul v-if="suggestions.length" class="suggestions left-0">
            <li
                v-for="(item, index) in suggestions"
                :key="index"
                @click="selectSuggestion(index)"
                :class="{ active: index === activeIndex }"
            >
                {{ item.description }}
            </li>
        </ul>
    </div>
</template>
<script setup>
import { ref, onMounted} from 'vue';
import TextInput from "@/Components/TextInput.vue";
import { useTranslate} from "@/Composables/useTranslate.js";

const {__} = useTranslate()
let search = ref('');
let suggestions = ref([]);
let activeIndex = ref(0);
let autocompleteService = {};

const props = defineProps({
    modelValue: String,
    border: {
        default: 'h-[50px] w-full'
    }
})
const emit = defineEmits(['update:modelValue'])
let updateInput = () => {
    searchLocation()

}

onMounted(() => {
    // Initialize Google Maps Autocomplete Service
    if (!window.google) {
        console.error("Google Maps JavaScript API not loaded!");
        return;
    }

    search.value = props.modelValue

    autocompleteService = new window.google.maps.places.AutocompleteService();
});

let searchLocation = () => {
    if (!search.value) {
        suggestions.value = [];
        return;
    }

    autocompleteService.getPlacePredictions(
        {
            input: search.value,
            componentRestrictions: { country: ['GB', 'FR'] }
        },
        (predictions, status) => {
            if (status !== window.google.maps.places.PlacesServiceStatus.OK) {
                console.error(status);
                return;
            }
            suggestions.value = predictions;
        }
    );
};

let incrementActiveIndex = () => {
    if (activeIndex.value < suggestions.value.length - 1) {
        activeIndex.value++;
    }
};

let decrementActiveIndex = () => {
    if (activeIndex.value > 0) {
        activeIndex.value--;
    }
};

let selectLocation = () => {
    if (suggestions.value.length && activeIndex.value >= 0) {
        selectSuggestion(activeIndex.value);
    }
};

let selectSuggestion = (index) => {
    search.value = suggestions.value[index].description;
    suggestions.value = [];
    emit('update:modelValue', search.value)
};


// ... rest of the code
</script>

<style scoped>
.search-container {
    position: relative;
}

.suggestions {
    position: absolute;
    width: 100%;
    background: white;
    border: 1px solid #ccc;
    list-style: none;
    margin: 0;
    padding: 0;
    z-index: 10;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.suggestions li {
    padding: 8px;
    cursor: pointer;
}

li.active {
    background-color: #eee;
}
</style>
