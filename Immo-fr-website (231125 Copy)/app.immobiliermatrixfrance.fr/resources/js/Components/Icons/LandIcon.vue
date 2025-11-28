<template>
    <svg width="14px" height="17px" viewBox="0 0 14 17" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <title>land</title>
        <g id="Designs" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g id="Property-Listing:-Spec" transform="translate(-658, -234)">
                <g id="Group-9" transform="translate(655, 229.9115)">
                    <g id="iconspace_Intersect_25px" transform="translate(0, 0.0885)">
                        <polygon id="Path" points="0 0 20 0 20 25 0 25"></polygon>
                        <g id="Group-6" transform="translate(3, 4)" :fill="fill" fill-rule="nonzero">
                            <path d="M10,11.3333333 L10,6.88095238 C10,5.76323324 9.25380792,4.85714286 8.33333333,4.85714286 L4.66666667,4.85714286 L4.66666667,1.21428571 C4.66666667,0.543654232 5.11438192,0 5.66666667,0 L13,0 C13.5522847,0 14,0.543654232 14,1.21428571 L14,10.1190476 C14,10.7896791 13.5522847,11.3333333 13,11.3333333 L10,11.3333333 Z" id="Path"></path>
                            <path d="M4,5.66666667 L4,9.71428571 C4,11.0555487 4.8954305,12.1428571 6,12.1428571 L9.33333333,12.1428571 L9.33333333,15.7857143 C9.33333333,16.4563458 8.88561808,17 8.33333333,17 L1,17 C0.44771525,17 0,16.4563458 0,15.7857143 L0,6.88095238 C0,6.2103209 0.44771525,5.66666667 1,5.66666667 L4,5.66666667 Z M4.66666667,5.66666667 L8.33333333,5.66666667 C8.88561808,5.66666667 9.33333333,6.2103209 9.33333333,6.88095238 L9.33333333,11.3333333 L6,11.3333333 C5.26362033,11.3333333 4.66666667,10.608461 4.66666667,9.71428571 L4.66666667,5.66666667 Z" id="Path"></path>
                        </g>
                    </g>
                </g>
            </g>
        </g>
    </svg>
</template>
<script setup>
import {ref} from "vue";

const props = defineProps({
    colour: {
        default: 'light'
    }
})

let fill = ref('#000000')

const setColour = () => {
    if (props.colour === 'light') {
        fill.value = '#ffffff'
    }
}

setColour()
</script>
