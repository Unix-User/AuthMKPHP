<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>

    <Head title="Welcome" />

    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-900 dark:bg-gray-100 sm:items-center sm:pt-0">
        <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            <Link v-if="$page.props.user" :href="route('dashboard')"
                class="text-sm text-gray-500 dark:text-gray-700 underline">Dashboard</Link>

            <template v-else>
                <Link :href="route('login')" class="text-sm text-gray-500 dark:text-gray-700 underline">Log in</Link>

                <Link v-if="canRegister" :href="route('register')"
                    class="ml-4 text-sm text-gray-500 dark:text-gray-700 underline">Register</Link>
            </template>
        </div>

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                <svg viewBox="0 0 651 192" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink">
                    <defs>
                        <radialGradient id="c" cx="30.204" cy="44.565" r="6.566"
                            gradientTransform="matrix(3.414541, 0, -0.004573, 2.69578, -76.247615, -95.517404)"
                            gradientUnits="userSpaceOnUse">
                            <stop offset="0" />
                            <stop stop-opacity="0" offset="1" />
                        </radialGradient>
                        <linearGradient id="d" x1="5.0704" x2="35.169" gradientUnits="userSpaceOnUse"
                            xlink:href="#gradient-1" />
                        <linearGradient id="gradient-1">
                            <stop stop-color="#fff" offset="0" />
                            <stop stop-color="#e5e5e5" offset="1" />
                        </linearGradient>
                        <radialGradient id="b" cx="88.593" cy="33.399" r="7.0056"
                            gradientTransform="matrix(.88944 .20922 -.17865 .75945 -34.977 -11.864)"
                            gradientUnits="userSpaceOnUse">
                            <stop stop-color="#cccccd" offset="0" />
                            <stop stop-color="#adadae" offset="0" />
                            <stop stop-color="#8f8f90" stop-opacity="0" offset="1" />
                        </radialGradient>
                        <linearGradient id="f" x1="31.693" x2=".90356" y1="22.252" y2="4.1312"
                            gradientUnits="userSpaceOnUse" xlink:href="#gradient-1" />
                        <radialGradient id="gradient-2" cx="30.204" cy="44.565" r="6.566"
                            gradientTransform="matrix(3.414541, 0, -0.004573, 2.69578, -76.247615, -95.517404)"
                            gradientUnits="userSpaceOnUse">
                            <stop offset="0" />
                            <stop stop-opacity="0" offset="1" />
                        </radialGradient>
                        <linearGradient id="gradient-1-1" x1="5.0704" x2="35.169" gradientUnits="userSpaceOnUse"
                            xlink:href="#gradient-1" />
                        <radialGradient id="gradient-3" cx="88.593" cy="33.399" r="7.0056"
                            gradientTransform="matrix(.88944 .20922 -.17865 .75945 -34.977 -11.864)"
                            gradientUnits="userSpaceOnUse">
                            <stop stop-color="#cccccd" offset="0" />
                            <stop stop-color="#adadae" offset="0" />
                            <stop stop-color="#8f8f90" stop-opacity="0" offset="1" />
                        </radialGradient>
                        <linearGradient id="gradient-1-2" x1="31.693" x2=".90356" y1="22.252" y2="4.1312"
                            gradientUnits="userSpaceOnUse" xlink:href="#gradient-1" />
                        <filter id="a">
                            <feBlend in2="BackgroundImage" mode="darken" />
                        </filter>
                    </defs>
                    <g transform="matrix(0.301176, 1.112501, 1.112501, -0.301176, 8.943623, 100.023422)" style="">
                        <path
                            d="M 49.101 24.616 C 49.078 38.242 30.381 46.758 15.445 39.945 C 8.514 36.783 4.251 30.94 4.262 24.616 C 4.285 10.991 22.982 2.475 37.917 9.287 C 44.849 12.449 49.112 18.293 49.101 24.616 Z"
                            fill="url(#c)" fill-rule="evenodd" opacity=".40642" style=""
                            transform="matrix(0.886293, 0.463125, -0.463125, 0.886293, 14.434283, -9.557824)" />
                        <path
                            d="m12.801 5.8182-7.6433 6.6986 0.25764 6.1404 17.992 16.188 11.594-10.735 0.25764-6.6986-22.457-11.594z"
                            fill="#484848" fill-rule="evenodd" stroke="#4d4d4d" stroke-linecap="round"
                            stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2" />
                        <path d="m5.0704 12.658 0.24671 5.9211 18.257 16.036-0.24671-6.4145-18.257-15.543z"
                            fill="#a6a6a6" fill-rule="evenodd" />
                        <path d="m23.327 28.201v6.5379l11.596-10.732 0.24671-6.6612-11.842 10.855z" fill="#7f7f7f"
                            fill-rule="evenodd" />
                        <path d="m5.0704 12.669 18.503 15.779 11.596-10.855-22.451-11.842-7.6481 6.9189z" fill="url(#d)"
                            fill-rule="evenodd" />
                        <path
                            d="m6.2665 11.645 2.8747 2.0003s0.67846 0.24671 0.98685 0 0.24671-0.98685 0.24671-0.98685l-2.8747-2.2579-1.2336 1.2445z"
                            fill="#ffc11a" fill-rule="evenodd" />
                        <path
                            d="m8.401 9.6711 2.9606 2.0003s0.67846 0.24671 0.98685 0 0.24671-0.98685 0.24671-0.98685l-2.8747-2.2579-1.3194 1.2445z"
                            fill="#ffc11a" fill-rule="evenodd" />
                        <path
                            d="m10.584 7.7348 2.8747 2.0861s0.67846 0.24671 0.98685 0 0.24671-0.98685 0.24671-0.98685l-2.9606-2.3438-1.1477 1.2445z"
                            fill="#ffc11a" fill-rule="evenodd" />
                        <path
                            d="m12.83 6.3689-7.0819 6.636 0.23872 5.3459 17.271 15.515 11.086-10.29 0.23871-5.6054-21.753-11.601z"
                            fill="none" opacity=".34225" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"
                            stroke-miterlimit="10" />
                        <path
                            d="M 31.564 28.211 C 31.564 28.211 37.404 30.53 40.495 35.253 C 43.587 39.976 45.305 46.847 45.305 46.847"
                            fill="none" stroke-linecap="round" stroke-linejoin="bevel" stroke-miterlimit="10"
                            stroke-width="5" style="stroke: rgb(81, 81, 82);" />
                        <path
                            d="m32.201 26.733c-0.83283 0.10088-1.4913 0.75356-1.5995 1.5855s0.36135 1.6313 1.1406 1.9419c0 0 4.8833 2.6652 6.5189 5.164 1.7888 2.7328 2.9825 7.1982 2.9825 7.1982 0.25341 0.98198 1.2549 1.5726 2.2369 1.3192s1.5726-1.2549 1.3192-2.2369c0 0-1.1005-4.7116-3.4413-8.2879-2.4941-3.8104-8.2396-6.5405-8.2396-6.5405-0.28855-0.12568-0.60456-0.17506-0.91769-0.14339z"
                            fill="url(#b)" fill-rule="evenodd" style="" />
                        <path
                            d="m15.926 15.865 15.05 11.349c1.727 1.1102 3.3923-0.18503 4.4408-1.4803s0.8635-2.8372-0.24671-3.7007l-16.036-8.635-3.2073 2.4671z"
                            fill="#a0a0a1" fill-rule="evenodd" />
                        <path
                            d="m15.309 15.865 15.42 9.3751c0.8635 0.61678 2.7138-0.12336 3.454-0.98685s0.12336-2.0971-0.49342-2.4671l-14.679-8.7583-3.7007 2.8372z"
                            fill="url(#f)" fill-rule="evenodd" />
                    </g>
                    <g transform="matrix(0.220475, -1.131265, -1.131265, -0.220475, 175.391495, 144.70697)" style="">
                        <path
                            d="M 49.101 24.616 C 49.078 38.242 30.381 46.758 15.445 39.945 C 8.514 36.783 4.251 30.94 4.262 24.616 C 4.285 10.991 22.982 2.475 37.917 9.287 C 44.849 12.449 49.112 18.293 49.101 24.616 Z"
                            fill="url(#gradient-2)" fill-rule="evenodd" opacity=".40642" style=""
                            transform="matrix(0.886293, 0.463125, -0.463125, 0.886293, 14.434283, -9.557824)" />
                        <path
                            d="m12.801 5.8182-7.6433 6.6986 0.25764 6.1404 17.992 16.188 11.594-10.735 0.25764-6.6986-22.457-11.594z"
                            fill="#484848" fill-rule="evenodd" stroke="#4d4d4d" stroke-linecap="round"
                            stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2" />
                        <path d="m5.0704 12.658 0.24671 5.9211 18.257 16.036-0.24671-6.4145-18.257-15.543z"
                            fill="#a6a6a6" fill-rule="evenodd" />
                        <path d="m23.327 28.201v6.5379l11.596-10.732 0.24671-6.6612-11.842 10.855z" fill="#7f7f7f"
                            fill-rule="evenodd" />
                        <path d="m5.0704 12.669 18.503 15.779 11.596-10.855-22.451-11.842-7.6481 6.9189z"
                            fill="url(#gradient-1-1)" fill-rule="evenodd" />
                        <path
                            d="m6.2665 11.645 2.8747 2.0003s0.67846 0.24671 0.98685 0 0.24671-0.98685 0.24671-0.98685l-2.8747-2.2579-1.2336 1.2445z"
                            fill="#ffc11a" fill-rule="evenodd" />
                        <path
                            d="m8.401 9.6711 2.9606 2.0003s0.67846 0.24671 0.98685 0 0.24671-0.98685 0.24671-0.98685l-2.8747-2.2579-1.3194 1.2445z"
                            fill="#ffc11a" fill-rule="evenodd" />
                        <path
                            d="m10.584 7.7348 2.8747 2.0861s0.67846 0.24671 0.98685 0 0.24671-0.98685 0.24671-0.98685l-2.9606-2.3438-1.1477 1.2445z"
                            fill="#ffc11a" fill-rule="evenodd" />
                        <path
                            d="m12.83 6.3689-7.0819 6.636 0.23872 5.3459 17.271 15.515 11.086-10.29 0.23871-5.6054-21.753-11.601z"
                            fill="none" opacity=".34225" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"
                            stroke-miterlimit="10" />
                        <path
                            d="M 31.564 28.211 C 31.564 28.211 37.404 30.53 40.495 35.253 C 43.587 39.976 45.305 46.847 45.305 46.847"
                            fill="none" stroke-linecap="round" stroke-linejoin="bevel" stroke-miterlimit="10"
                            stroke-width="5" style="stroke: rgb(81, 81, 82);" />
                        <path
                            d="m32.201 26.733c-0.83283 0.10088-1.4913 0.75356-1.5995 1.5855s0.36135 1.6313 1.1406 1.9419c0 0 4.8833 2.6652 6.5189 5.164 1.7888 2.7328 2.9825 7.1982 2.9825 7.1982 0.25341 0.98198 1.2549 1.5726 2.2369 1.3192s1.5726-1.2549 1.3192-2.2369c0 0-1.1005-4.7116-3.4413-8.2879-2.4941-3.8104-8.2396-6.5405-8.2396-6.5405-0.28855-0.12568-0.60456-0.17506-0.91769-0.14339z"
                            fill="url(#gradient-3)" fill-rule="evenodd" style="" />
                        <path
                            d="m15.926 15.865 15.05 11.349c1.727 1.1102 3.3923-0.18503 4.4408-1.4803s0.8635-2.8372-0.24671-3.7007l-16.036-8.635-3.2073 2.4671z"
                            fill="#a0a0a1" fill-rule="evenodd" />
                        <path
                            d="m15.309 15.865 15.42 9.3751c0.8635 0.61678 2.7138-0.12336 3.454-0.98685s0.12336-2.0971-0.49342-2.4671l-14.679-8.7583-3.7007 2.8372z"
                            fill="url(#gradient-1-2)" fill-rule="evenodd" />
                    </g>
                    <g transform="matrix(0.732641, 0, 0, 0.732641, 37.562393, 5.49489)" style="">
                        <g transform="translate(-9.2602 -29.403)">
                            <path
                                d="m92.186 245.3c-4.968-6.1541-16.39 1.4408-23.019 5.7547-6.5394 4.2556-18.765 12.005-14.387 18.463 5.7906 8.5425 21.826-2 29.733-8.6321 4.4366-3.7213 11.31-11.08 7.673-15.586z"
                                fill="#f95" stroke="#a40" stroke-width="1.2102" />
                        </g>
                        <g transform="translate(-9.2602 -29.403)">
                            <path
                                d="m41.992 126.34c-43.463-63.603 11.935-96.441 48.058-96.056 23.263 0.24808 69.673 33.586 49.264 86.561 0 0 25.514-19.823 28.145-17.294 18.298 17.585-24.076 72.228-24.076 72.228-2.4315 27.684 15.383 33.856 32.893 40.353-23.176 51.215-159.04 69.31-134.28-38.657-7.7378-0.41475-41.551-46.881-29.163-56.63 3.2149-2.53 29.163 9.4948 29.163 9.4948z"
                                fill="#3771c8" stroke="#214478" stroke-width="1.7322" />
                        </g>
                        <g transform="translate(-9.2602 -29.403)">
                            <path
                                d="m69.887 140.76c-64.915-18.935-27.039-123.93 8.8719-41.482 43.852-76.866 92.838 17.779 22.779 41.242-0.8591 52.299 39.858 58.427 33.809 84.163-10.187 43.339-119.38 28.931-83.145-64.029 3.056-7.8406 7.97-13.52 17.685-19.894z"
                                fill="#fff" />
                        </g>
                        <g transform="translate(-577.74 -54.259)" fill="#214478">
                            <path
                                d="m610.17 201.28c0.4451-1.2512 1.0291-2.4326 1.3371-3.6722 6.4842-26.091 10.689-25.891 17.654-31.294-11.4 2.0276-17.414 18.643-19.467 31.911-0.21535 1.3912 0.68184 1.7078 0.47663 3.0542z" />
                            <path
                                d="m611.44 151.09c2.3673 3.7332 9.3762 11.356 17.703 15.239-5.7584-0.50908-16.383-11.396-20.562-16.639-0.42409-0.53209 3.1259 1.9259 2.8588 1.4004z" />
                            <path
                                d="m709.68 139.2c-9.1207 8.9604-18.262 17.896-26.136 28.414 7.585-8.4802 15.428-16.53 23.492-24.211l2.6436-4.2028z" />
                            <path d="m712.68 196.93-14.087 14.567 12.469-15.226 1.6185 0.6594z" />
                        </g>
                        <g transform="translate(-9.2602 -29.403)">
                            <path
                                d="m74.443 198.3c-8.1192 5.2951 1.3862 20.196 6.7138 28.294 4.929 7.4918 13.789 20.507 21.58 16.065 7.2617-4.1396 1.4728-17.659-2.6376-24.937-5.2747-9.3398-16.672-25.282-25.656-19.422z"
                                fill="#f95" stroke="#a40" stroke-linejoin="round" stroke-width="1.2339" />
                        </g>
                        <g transform="translate(-9.2602 -29.403)">
                            <path
                                d="m78.519 108.39c-2.4564-0.27807-15.028 7.408-14.866 10.071 0.2146 3.5367 12.191 12.9 15.825 12.708 3.1842-0.16808 13.015-6.889 13.188-10.311 0.2209-4.3596-11.382-12.156-14.147-12.469z"
                                fill="#f95" stroke="#a40" stroke-width="1.1153" />
                        </g>
                        <g transform="translate(-9.2602 -29.403)">
                            <path
                                d="m70.633 121.19s4.8475 5.8283 7.263 6.004c2.4806 0.1805 8.429-5.3415 8.429-5.3415-5.4806 0.34152-10.845 0.42095-15.692-0.66252z"
                                fill="#a02c2c" />
                        </g>
                        <g transform="translate(-9.2602 -29.403)">
                            <path
                                d="m63.556 118.33c5.2133 4.4216 16.842 5.2314 29.403 2.3079-4.8923-0.0879-17.208 3.6422-29.403-2.3079z"
                                fill="#a40" />
                            <path
                                d="m80.476 141.32c-5.3654 2.1341-11.977 5.5295-16.185 14.207 5.6351-1.4041 6.942-2.5196 10.37-3.7765-3.0367 3.3968-3.7405 6.5816-5.1553 9.831 1.7442-4.5955 5.749-9.7204 9.7111-12.409-5.0585 2.2031-9.0056 4.0233-13.068 5.0354 3.2856-6.6552 7.4479-8.6804 14.327-12.888z"
                                fill="#acf" />
                        </g>
                        <g transform="translate(-9.2602 -29.403)" filter="url(#a)" opacity=".45">
                            <path
                                d="m78.356 108.23c2.1854-1.2099-2.274 13.447-1.9498 13.734 1.5978 1.41 3.5744 8.3063 1.9186 8.9506-1.6653 0.64791-6.9744-4.9628-9.4053-5.8575-4.7186-1.7367-5.2045-6.5943-5.066-7.0733 0.88564-3.0635 11.401-8.0363 14.503-9.7534z"
                                fill="#d45500" />
                        </g>
                        <g transform="translate(-577.74 -54.259)" fill="#fff" opacity=".2045">
                            <path
                                d="m649.27 135.89c-1.5648 1.3826-2.4205 2.1621-1.9315 7.6331 0.13231 1.4803 9.6824 2.9554 11.03 1.1989 0.84433-1.1006-7.689-10.077-9.0984-8.832z" />
                            <path
                                d="m660.39 56.06c27.16 5.907 67.128 36.419 46.318 86.311l27.606-17.474c13.592 13.838-3.0809 41.582-22.381 70.533-5.232 17.98 4.5582 32.205 31.875 42.048-7.1418 11.109-5.9696 21.768-44.761 34.588-26.044-6.2762-22.018-60.129-58.387-104.4-54.845-66.766-27.476-103.07 19.73-111.6z"
                                fill-opacity=".4047" opacity=".9233" />
                        </g>
                        <g transform="translate(-9.2602 -29.403)">
                            <path
                                d="m41.353 102.87c5.6903-10.056 17.658-10.454 27.814-6.4741-11.87-11.952-24.377-9.3699-27.814 6.4741z" />
                            <path
                                d="m90.748 98.554c8.8586-6.6266 18.397-5.441 28.534 2.6376-7.6757-15.02-18.574-15.094-28.534-2.6376z" />
                        </g>
                    </g>
                    <text
                        style="fill: rgb(70, 124, 204); font-family: &quot;Ink Free&quot;; font-size: 82px; font-weight: 700; white-space: pre;"
                        x="202.91" y="119.818">AuthMKPHP</text>
                </svg>
            </div>

            <div class="mt-8 bg-gray-800 dark:bg-white overflow-hidden shadow sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="p-6">
                        <div class="flex items-center">
                            <svg stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                class="w-8 h-8 text-gray-500" viewBox="0 0 576 512">
                                <path
                                    d="M184.1 38.2c9.9 8.9 10.7 24 1.8 33.9l-72 80c-4.4 4.9-10.6 7.8-17.2 7.9s-12.9-2.4-17.6-7L39 113c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l22.1 22.1 55.1-61.2c8.9-9.9 24-10.7 33.9-1.8zm0 160c9.9 8.9 10.7 24 1.8 33.9l-72 80c-4.4 4.9-10.6 7.8-17.2 7.9s-12.9-2.4-17.6-7L39 273c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l22.1 22.1 55.1-61.2c8.9-9.9 24-10.7 33.9-1.8zM256 96c0-17.7 14.3-32 32-32H512c17.7 0 32 14.3 32 32s-14.3 32-32 32H288c-17.7 0-32-14.3-32-32zm0 160c0-17.7 14.3-32 32-32H512c17.7 0 32 14.3 32 32s-14.3 32-32 32H288c-17.7 0-32-14.3-32-32zM192 416c0-17.7 14.3-32 32-32H512c17.7 0 32 14.3 32 32s-14.3 32-32 32H224c-17.7 0-32-14.3-32-32zM80 464c-26.5 0-48-21.5-48-48s21.5-48 48-48s48 21.5 48 48s-21.5 48-48 48z" />
                            </svg>
                            <div class="ml-4 text-lg leading-7 font-semibold">
                                <a href="#" class="underline text-white dark:text-gray-900">Gestão</a>
                            </div>
                        </div>

                        <div class="ml-12">
                            <div class="mt-2 text-gray-400 dark:text-gray-600 text-sm">
                                AuthMKPHP tem uma maravilhosa e completa lista de ferramentas para gerenciar
                                todos os aspectos de sua estrutura de rede pra você que é novo ou já tem experiência
                                anterior com Mikrotik.
                            </div>
                        </div>
                    </div>

                    <div class="p-6 border-t border-gray-700 dark:border-gray-200 md:border-t-0 md:border-l">
                        <div class="flex items-center">
                            <svg stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                class="w-8 h-8 text-gray-500" viewBox="0 0 640 512">
                                <path
                                    d="M392.8 1.2c-17-4.9-34.7 5-39.6 22l-128 448c-4.9 17 5 34.7 22 39.6s34.7-5 39.6-22l128-448c4.9-17-5-34.7-22-39.6zm80.6 120.1c-12.5 12.5-12.5 32.8 0 45.3L562.7 256l-89.4 89.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l112-112c12.5-12.5 12.5-32.8 0-45.3l-112-112c-12.5-12.5-32.8-12.5-45.3 0zm-306.7 0c-12.5-12.5-32.8-12.5-45.3 0l-112 112c-12.5 12.5-12.5 32.8 0 45.3l112 112c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256l89.4-89.4c12.5-12.5 12.5-32.8 0-45.3z" />
                            </svg>
                            <div class="ml-4 text-lg leading-7 font-semibold">
                                <a href="#" class="underline text-white dark:text-gray-900">Desenvolvimento</a>
                            </div>
                        </div>

                        <div class="ml-12">
                            <div class="mt-2 text-gray-400 dark:text-gray-600 text-sm">
                                AuthMKPHP foi desenvolvido usando Laravel, PHP, e JavaScript, possibilitando
                                a implementação na maioria dos serviços de hospedagem disponiveis na web
                                facilitando o processo de configuração da aplicação.
                            </div>
                        </div>
                    </div>

                    <div class="p-6 border-t border-gray-700 dark:border-gray-200">
                        <div class="flex items-center">
                            <svg stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                class="w-8 h-8 text-gray-500" viewBox="0 0 640 512">
                                <path
                                    d="M320 0c17.7 0 32 14.3 32 32V96H480c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H160c-35.3 0-64-28.7-64-64V160c0-35.3 28.7-64 64-64H288V32c0-17.7 14.3-32 32-32zM208 384c-8.8 0-16 7.2-16 16s7.2 16 16 16h32c8.8 0 16-7.2 16-16s-7.2-16-16-16H208zm96 0c-8.8 0-16 7.2-16 16s7.2 16 16 16h32c8.8 0 16-7.2 16-16s-7.2-16-16-16H304zm96 0c-8.8 0-16 7.2-16 16s7.2 16 16 16h32c8.8 0 16-7.2 16-16s-7.2-16-16-16H400zM264 256c0-22.1-17.9-40-40-40s-40 17.9-40 40s17.9 40 40 40s40-17.9 40-40zm152 40c22.1 0 40-17.9 40-40s-17.9-40-40-40s-40 17.9-40 40s17.9 40 40 40zM48 224H64V416H48c-26.5 0-48-21.5-48-48V272c0-26.5 21.5-48 48-48zm544 0c26.5 0 48 21.5 48 48v96c0 26.5-21.5 48-48 48H576V224h16z" />
                            </svg>
                            <div class="ml-4 text-lg leading-7 font-semibold">
                                <a href="#" class="underline text-white dark:text-gray-900">Automatização</a>
                            </div>
                        </div>

                        <div class="ml-12">
                            <div class="mt-2 text-gray-400 dark:text-gray-600 text-sm">
                                Automatize tarefas repetitivas, agende execução de sincronizações
                                em multiplos dispositivos. O AuthMKPHP possui ferramentas para
                                automatizar, contabilizar e sincronizar as informações em seu
                                Mikrotik de forma padronizada.
                            </div>
                        </div>
                    </div>

                    <div class="p-6 border-t border-gray-700 dark:border-gray-200 md:border-l">
                        <div class="flex items-center">
                            <svg stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                class="w-8 h-8 text-gray-500" viewBox="0 0 640 512">
                                <path
                                    d="M535 41c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l64 64c4.5 4.5 7 10.6 7 17s-2.5 12.5-7 17l-64 64c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l23-23L384 112c-13.3 0-24-10.7-24-24s10.7-24 24-24l174.1 0L535 41zM105 377l-23 23L256 400c13.3 0 24 10.7 24 24s-10.7 24-24 24L81.9 448l23 23c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0L7 441c-4.5-4.5-7-10.6-7-17s2.5-12.5 7-17l64-64c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9zM96 64H337.9c-3.7 7.2-5.9 15.3-5.9 24c0 28.7 23.3 52 52 52l117.4 0c-4 17 .6 35.5 13.8 48.8c20.3 20.3 53.2 20.3 73.5 0L608 169.5V384c0 35.3-28.7 64-64 64H302.1c3.7-7.2 5.9-15.3 5.9-24c0-28.7-23.3-52-52-52l-117.4 0c4-17-.6-35.5-13.8-48.8c-20.3-20.3-53.2-20.3-73.5 0L32 342.5V128c0-35.3 28.7-64 64-64zm64 64H96v64c35.3 0 64-28.7 64-64zM544 320c-35.3 0-64 28.7-64 64h64V320zM320 352c53 0 96-43 96-96s-43-96-96-96s-96 43-96 96s43 96 96 96z" />
                            </svg>
                            <div class="ml-4 text-lg leading-7 font-semibold text-white dark:text-gray-900">
                                Integração de Pagamentos
                            </div>
                        </div>

                        <div class="ml-12">
                            <div class="mt-2 text-gray-400 dark:text-gray-600 text-sm">
                                AuthMKPHP já esta integrado a plataformas de pagamento como <a href="#"
                                    class="underline">Mercado Pago</a> e <a href="#" class="underline">PagSeguro</a>
                                possibilitando o processamento de pagamentos recebidos e liberando a conexão de seus
                                clientes automáticamente
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
                <div class="text-center text-sm text-gray-500 sm:text-left">
                    <div class="flex items-center">
                        <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            viewBox="0 0 24 24" stroke="currentColor" class="-mt-px w-5 h-5 text-gray-400">
                            <path
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>

                        <a href="#" class="ml-1 underline">
                            Shop
                        </a>

                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" viewBox="0 0 24 24" class="ml-4 -mt-px w-5 h-5 text-gray-400">
                            <path
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>

                        <a href="#" class="ml-1 underline">
                            Sponsor
                        </a>
                    </div>
                </div>

                <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                    Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
                </div>
            </div>
        </div>
    </div>
</template>
