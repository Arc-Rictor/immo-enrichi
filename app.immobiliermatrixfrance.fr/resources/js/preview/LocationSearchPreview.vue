<template>
    <input
        :value="modelValue"
        v-bind="$attrs"
        type="text"
        @input="$emit('update:modelValue', $event.target.value)"
    >
</template>

<script setup>
defineOptions({inheritAttrs: false})
defineProps({modelValue: {type: String, default: ''}})
defineEmits(['update:modelValue'])
</script>
