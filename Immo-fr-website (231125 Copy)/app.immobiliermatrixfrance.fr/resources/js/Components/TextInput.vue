<template>
    <input
        ref="input"
        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm" :class="height"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    >
</template>
<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: String,
    height: {
        default: 'h-[65px]'
    }
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>
