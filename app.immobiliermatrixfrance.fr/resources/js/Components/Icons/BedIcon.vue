<template>
    <svg width="21px" height="13px" viewBox="0 0 21 13" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <title>beds</title>
        <g id="Designs" stroke="none" stroke-width="1" :fill="bg" fill-rule="evenodd">
            <g id="Property-Listing:-Spec" transform="translate(-416, -237)">
                <g id="bed-side-a" transform="translate(414, 227)">
                    <rect id="Rectangle" x="0" y="0" width="25" height="31"></rect>
                    <g id="Group-5" transform="translate(2, 10)" :fill="fill" fill-rule="nonzero">
                        <ellipse id="Oval" cx="16.38" cy="3.5" rx="2.1" ry="2.5"></ellipse>
                        <path d="M3.3516,6.0044 C5.908644,6.0175 13.483596,6.0519 13.44,6 L13.44,2.0334 C13.4390593,1.75497 13.3412766,1.48944305 13.169905,1.29996244 C12.9985335,1.11048183 12.7688854,1.01397803 12.535572,1.0334 C9.29019148,1.4333401 6.10413501,2.34693231 3.061716,3.75 C2.73506573,3.89691368 2.51920666,4.26960525 2.51998938,4.6853 L2.51998938,5.0044 C2.51888329,5.26829141 2.60587134,5.52190227 2.7618272,5.70943937 C2.91778305,5.89697648 3.12993119,6.00307724 3.3516,6.0044 Z" id="Path"></path>
                        <path d="M20.58,0 C20.3480404,0 20.16,0.223857625 20.16,0.5 L20.16,7 L0.84,7 L0.84,5.5 C0.84,5.22385763 0.651959595,5 0.42,5 C0.188040405,5 0,5.22385763 0,5.5 L0,10 L21,10 L21,0.5 C21,0.223857625 20.8119596,0 20.58,0 Z" id="Path"></path>
                        <path d="M0,12 L0,12.5 C0,12.7761424 0.188040405,13 0.42,13 C0.651959595,13 0.84,12.7761424 0.84,12.5 L0.84,12 L20.16,12 L20.16,12.5 C20.16,12.7761424 20.3480404,13 20.58,13 C20.8119596,13 21,12.7761424 21,12.5 L21,11 L0,11 L0,12 Z" id="Path"></path>
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

let bg = ref('#ffffff')
let fill = ref('#000000')

const setColour = () => {
    if (props.colour === 'light') {
        bg.value = '#000000'
        fill.value = '#ffffff'
    }
}

setColour()
</script>
