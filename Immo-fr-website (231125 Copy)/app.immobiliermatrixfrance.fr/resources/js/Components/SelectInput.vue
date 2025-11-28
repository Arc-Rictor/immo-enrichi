<template>
    <select
        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm"
        :class="height"
        @change="$emit('update:modelValue', $event.target.value)"
    >
        <slot/>
    </select>
</template>
<script setup>
import {ref} from 'vue';

defineProps({
    modelValue: String,
    height: {
        default: 'h-[65px]'
    }
});

defineEmits(['update:modelValue']);

const input = ref(null);


defineExpose({focus: () => input.value.focus()});
</script>
