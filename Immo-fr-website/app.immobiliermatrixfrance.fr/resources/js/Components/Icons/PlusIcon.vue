<template>
    <svg width="17px" height="17px" viewBox="0 0 17 17" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <title>Plus</title>
        <g id="Designs" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g id="Dashboard" transform="translate(-735, -73)" :fill="fill">
                <g id="Group-11" transform="translate(735, 73)">
                    <rect id="Rectangle" x="7" y="0" width="3" height="17"></rect>
                    <polygon id="Rectangle" transform="translate(8.5, 8.5) rotate(-90) translate(-8.5, -8.5)" points="7 6.0054795e-16 10 6.0054795e-16 10 17 7 17"></polygon>
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
