<!--
    Preview-only. Substituted for Components/ApplicationLogo.vue via an alias in
    vite.preview.config.js, because the real component is application source and
    read-only on this branch. Carries the new Immo-Allie mark.

    The supplied artwork sat off-centre in a 1000x240 canvas (ink spanned
    x 159-716, leaving a 284px gap on the right). Only the viewBox is adjusted
    here to centre it; the artwork itself is untouched.

    The wordmark is live <text> in Inter, so preview.html loads Inter. If Inter
    is ever unavailable the browser substitutes a fallback face; the padding in
    the viewBox leaves room for that.
-->
<template>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="109 3 657 234" role="img" aria-labelledby="title desc">
      <title id="title">Immo-Allié logo — black</title>
      <desc id="desc">A modern Immo-Allié wordmark. A bold house with a chimney replaces the letter A, with the A carved into the house.</desc>
      <defs>
        <mask id="house-a-cutout-black" maskUnits="userSpaceOnUse" x="410" y="35" width="180" height="160">
          <rect x="410" y="35" width="180" height="160" fill="white"/>
          <!-- The transparent letterform makes the A unmistakable at every size. -->
          <path d="M500 74 456 169h28l9-23h15l9 23h28L500 74Z" fill="black"/>
          <path d="m500 111-8 21h16l-8-21Z" fill="white"/>
        </mask>
      </defs>

      <g fill="#111111" font-family="Inter, Montserrat, Avenir Next, Helvetica Neue, Arial, sans-serif" font-size="96" font-weight="650" letter-spacing="-4">
        <text x="404" y="174" text-anchor="end">Immo</text>
        <text x="596" y="174">llié</text>
      </g>

      <!-- One confident shape: pitched roof, chimney and walls, carrying a negative-space A. -->
      <path d="M424 109 500 43l39 34V48h23v49l14 12v69H424v-69Z"
            fill="#111111" stroke="#111111" stroke-width="7" stroke-linejoin="round"
            mask="url(#house-a-cutout-black)"/>
    </svg>
</template>
