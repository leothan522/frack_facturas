<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicons/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicons/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicons/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicons/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicons/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicons/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicons/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicons/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicons/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicons/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('favicons/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    <!-- Styles -->
    <style>
        /* ! tailwindcss v3.2.4 | MIT License | https://tailwindcss.com */
        *, ::after, ::before {
            box-sizing: border-box;
            border-width: 0;
            border-style: solid;
            border-color: #e5e7eb
        }

        ::after, ::before {
            --tw-content: ''
        }

        html {
            line-height: 1.5;
            -webkit-text-size-adjust: 100%;
            -moz-tab-size: 4;
            tab-size: 4;
            font-family: Figtree, sans-serif;
            font-feature-settings: normal
        }

        body {
            margin: 0;
            line-height: inherit
        }

        hr {
            height: 0;
            color: inherit;
            border-top-width: 1px
        }

        abbr:where([title]) {
            -webkit-text-decoration: underline dotted;
            text-decoration: underline dotted
        }

        h1, h2, h3, h4, h5, h6 {
            font-size: inherit;
            font-weight: inherit
        }

        a {
            color: inherit;
            text-decoration: inherit
        }

        b, strong {
            font-weight: bolder
        }

        code, kbd, pre, samp {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            font-size: 1em
        }

        small {
            font-size: 80%
        }

        sub, sup {
            font-size: 75%;
            line-height: 0;
            position: relative;
            vertical-align: baseline
        }

        sub {
            bottom: -.25em
        }

        sup {
            top: -.5em
        }

        table {
            text-indent: 0;
            border-color: inherit;
            border-collapse: collapse
        }

        button, input, optgroup, select, textarea {
            font-family: inherit;
            font-size: 100%;
            font-weight: inherit;
            line-height: inherit;
            color: inherit;
            margin: 0;
            padding: 0
        }

        button, select {
            text-transform: none
        }

        [type=button], [type=reset], [type=submit], button {
            -webkit-appearance: button;
            background-color: transparent;
            background-image: none
        }

        :-moz-focusring {
            outline: auto
        }

        :-moz-ui-invalid {
            box-shadow: none
        }

        progress {
            vertical-align: baseline
        }

        ::-webkit-inner-spin-button, ::-webkit-outer-spin-button {
            height: auto
        }

        [type=search] {
            -webkit-appearance: textfield;
            outline-offset: -2px
        }

        ::-webkit-search-decoration {
            -webkit-appearance: none
        }

        ::-webkit-file-upload-button {
            -webkit-appearance: button;
            font: inherit
        }

        summary {
            display: list-item
        }

        blockquote, dd, dl, figure, h1, h2, h3, h4, h5, h6, hr, p, pre {
            margin: 0
        }

        fieldset {
            margin: 0;
            padding: 0
        }

        legend {
            padding: 0
        }

        menu, ol, ul {
            list-style: none;
            margin: 0;
            padding: 0
        }

        textarea {
            resize: vertical
        }

        input::placeholder, textarea::placeholder {
            opacity: 1;
            color: #9ca3af
        }

        [role=button], button {
            cursor: pointer
        }

        :disabled {
            cursor: default
        }

        audio, canvas, embed, iframe, img, object, svg, video {
            display: block;
            vertical-align: middle
        }

        img, video {
            max-width: 100%;
            height: auto
        }

        [hidden] {
            display: none
        }

        *, ::before, ::after {
            --tw-border-spacing-x: 0;
            --tw-border-spacing-y: 0;
            --tw-translate-x: 0;
            --tw-translate-y: 0;
            --tw-rotate: 0;
            --tw-skew-x: 0;
            --tw-skew-y: 0;
            --tw-scale-x: 1;
            --tw-scale-y: 1;
            --tw-pan-x: ;
            --tw-pan-y: ;
            --tw-pinch-zoom: ;
            --tw-scroll-snap-strictness: proximity;
            --tw-ordinal: ;
            --tw-slashed-zero: ;
            --tw-numeric-figure: ;
            --tw-numeric-spacing: ;
            --tw-numeric-fraction: ;
            --tw-ring-inset: ;
            --tw-ring-offset-width: 0px;
            --tw-ring-offset-color: #fff;
            --tw-ring-color: rgb(59 130 246 / 0.5);
            --tw-ring-offset-shadow: 0 0 #0000;
            --tw-ring-shadow: 0 0 #0000;
            --tw-shadow: 0 0 #0000;
            --tw-shadow-colored: 0 0 #0000;
            --tw-blur: ;
            --tw-brightness: ;
            --tw-contrast: ;
            --tw-grayscale: ;
            --tw-hue-rotate: ;
            --tw-invert: ;
            --tw-saturate: ;
            --tw-sepia: ;
            --tw-drop-shadow: ;
            --tw-backdrop-blur: ;
            --tw-backdrop-brightness: ;
            --tw-backdrop-contrast: ;
            --tw-backdrop-grayscale: ;
            --tw-backdrop-hue-rotate: ;
            --tw-backdrop-invert: ;
            --tw-backdrop-opacity: ;
            --tw-backdrop-saturate: ;
            --tw-backdrop-sepia:
        }

        ::-webkit-backdrop {
            --tw-border-spacing-x: 0;
            --tw-border-spacing-y: 0;
            --tw-translate-x: 0;
            --tw-translate-y: 0;
            --tw-rotate: 0;
            --tw-skew-x: 0;
            --tw-skew-y: 0;
            --tw-scale-x: 1;
            --tw-scale-y: 1;
            --tw-pan-x: ;
            --tw-pan-y: ;
            --tw-pinch-zoom: ;
            --tw-scroll-snap-strictness: proximity;
            --tw-ordinal: ;
            --tw-slashed-zero: ;
            --tw-numeric-figure: ;
            --tw-numeric-spacing: ;
            --tw-numeric-fraction: ;
            --tw-ring-inset: ;
            --tw-ring-offset-width: 0px;
            --tw-ring-offset-color: #fff;
            --tw-ring-color: rgb(59 130 246 / 0.5);
            --tw-ring-offset-shadow: 0 0 #0000;
            --tw-ring-shadow: 0 0 #0000;
            --tw-shadow: 0 0 #0000;
            --tw-shadow-colored: 0 0 #0000;
            --tw-blur: ;
            --tw-brightness: ;
            --tw-contrast: ;
            --tw-grayscale: ;
            --tw-hue-rotate: ;
            --tw-invert: ;
            --tw-saturate: ;
            --tw-sepia: ;
            --tw-drop-shadow: ;
            --tw-backdrop-blur: ;
            --tw-backdrop-brightness: ;
            --tw-backdrop-contrast: ;
            --tw-backdrop-grayscale: ;
            --tw-backdrop-hue-rotate: ;
            --tw-backdrop-invert: ;
            --tw-backdrop-opacity: ;
            --tw-backdrop-saturate: ;
            --tw-backdrop-sepia:
        }

        ::backdrop {
            --tw-border-spacing-x: 0;
            --tw-border-spacing-y: 0;
            --tw-translate-x: 0;
            --tw-translate-y: 0;
            --tw-rotate: 0;
            --tw-skew-x: 0;
            --tw-skew-y: 0;
            --tw-scale-x: 1;
            --tw-scale-y: 1;
            --tw-pan-x: ;
            --tw-pan-y: ;
            --tw-pinch-zoom: ;
            --tw-scroll-snap-strictness: proximity;
            --tw-ordinal: ;
            --tw-slashed-zero: ;
            --tw-numeric-figure: ;
            --tw-numeric-spacing: ;
            --tw-numeric-fraction: ;
            --tw-ring-inset: ;
            --tw-ring-offset-width: 0px;
            --tw-ring-offset-color: #fff;
            --tw-ring-color: rgb(59 130 246 / 0.5);
            --tw-ring-offset-shadow: 0 0 #0000;
            --tw-ring-shadow: 0 0 #0000;
            --tw-shadow: 0 0 #0000;
            --tw-shadow-colored: 0 0 #0000;
            --tw-blur: ;
            --tw-brightness: ;
            --tw-contrast: ;
            --tw-grayscale: ;
            --tw-hue-rotate: ;
            --tw-invert: ;
            --tw-saturate: ;
            --tw-sepia: ;
            --tw-drop-shadow: ;
            --tw-backdrop-blur: ;
            --tw-backdrop-brightness: ;
            --tw-backdrop-contrast: ;
            --tw-backdrop-grayscale: ;
            --tw-backdrop-hue-rotate: ;
            --tw-backdrop-invert: ;
            --tw-backdrop-opacity: ;
            --tw-backdrop-saturate: ;
            --tw-backdrop-sepia:
        }

        .relative {
            position: relative
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto
        }

        .mx-6 {
            margin-left: 1.5rem;
            margin-right: 1.5rem
        }

        .ml-4 {
            margin-left: 1rem
        }

        .mt-16 {
            margin-top: 4rem
        }

        .mt-6 {
            margin-top: 1.5rem
        }

        .mt-4 {
            margin-top: 1rem
        }

        .-mt-px {
            margin-top: -1px
        }

        .mr-1 {
            margin-right: 0.25rem
        }

        .flex {
            display: flex
        }

        .inline-flex {
            display: inline-flex
        }

        .grid {
            display: grid
        }

        .h-16 {
            height: 4rem
        }

        .h-7 {
            height: 1.75rem
        }

        .h-6 {
            height: 1.5rem
        }

        .h-5 {
            height: 1.25rem
        }

        .min-h-screen {
            min-height: 100vh
        }

        .w-auto {
            width: auto
        }

        .w-16 {
            width: 4rem
        }

        .w-7 {
            width: 1.75rem
        }

        .w-6 {
            width: 1.5rem
        }

        .w-5 {
            width: 1.25rem
        }

        .max-w-7xl {
            max-width: 80rem
        }

        .shrink-0 {
            flex-shrink: 0
        }

        .scale-100 {
            --tw-scale-x: 1;
            --tw-scale-y: 1;
            transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))
        }

        .grid-cols-1 {
            grid-template-columns:repeat(1, minmax(0, 1fr))
        }

        .items-center {
            align-items: center
        }

        .justify-center {
            justify-content: center
        }

        .gap-6 {
            gap: 1.5rem
        }

        .gap-4 {
            gap: 1rem
        }

        .self-center {
            align-self: center
        }

        .rounded-lg {
            border-radius: 0.5rem
        }

        .rounded-full {
            border-radius: 9999px
        }

        .bg-gray-100 {
            --tw-bg-opacity: 1;
            background-color: rgb(243 244 246 / var(--tw-bg-opacity))
        }

        .bg-white {
            --tw-bg-opacity: 1;
            background-color: rgb(255 255 255 / var(--tw-bg-opacity))
        }

        .bg-red-50 {
            --tw-bg-opacity: 1;
            background-color: rgb(254 242 242 / var(--tw-bg-opacity))
        }

        .bg-dots-darker {
            background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E")
        }

        .from-gray-700\/50 {
            --tw-gradient-from: rgb(55 65 81 / 0.5);
            --tw-gradient-to: rgb(55 65 81 / 0);
            --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to)
        }

        .via-transparent {
            --tw-gradient-to: rgb(0 0 0 / 0);
            --tw-gradient-stops: var(--tw-gradient-from), transparent, var(--tw-gradient-to)
        }

        .bg-center {
            background-position: center
        }

        .stroke-red-500 {
            stroke: #ef4444
        }

        .stroke-gray-400 {
            stroke: #9ca3af
        }

        .p-6 {
            padding: 1.5rem
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem
        }

        .text-center {
            text-align: center
        }

        .text-right {
            text-align: right
        }

        .text-xl {
            font-size: 1.25rem;
            line-height: 1.75rem
        }

        .text-sm {
            font-size: 0.875rem;
            line-height: 1.25rem
        }

        .font-semibold {
            font-weight: 600
        }

        .leading-relaxed {
            line-height: 1.625
        }

        .text-gray-600 {
            --tw-text-opacity: 1;
            color: rgb(75 85 99 / var(--tw-text-opacity))
        }

        .text-gray-900 {
            --tw-text-opacity: 1;
            color: rgb(17 24 39 / var(--tw-text-opacity))
        }

        .text-gray-500 {
            --tw-text-opacity: 1;
            color: rgb(107 114 128 / var(--tw-text-opacity))
        }

        .underline {
            -webkit-text-decoration-line: underline;
            text-decoration-line: underline
        }

        .antialiased {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }

        .shadow-2xl {
            --tw-shadow: 0 25px 50px -12px rgb(0 0 0 / 0.25);
            --tw-shadow-colored: 0 25px 50px -12px var(--tw-shadow-color);
            box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)
        }

        .shadow-gray-500\/20 {
            --tw-shadow-color: rgb(107 114 128 / 0.2);
            --tw-shadow: var(--tw-shadow-colored)
        }

        .transition-all {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 150ms
        }

        .selection\:bg-red-500 *::selection {
            --tw-bg-opacity: 1;
            background-color: rgb(239 68 68 / var(--tw-bg-opacity))
        }

        .selection\:text-white *::selection {
            --tw-text-opacity: 1;
            color: rgb(255 255 255 / var(--tw-text-opacity))
        }

        .selection\:bg-red-500::selection {
            --tw-bg-opacity: 1;
            background-color: rgb(239 68 68 / var(--tw-bg-opacity))
        }

        .selection\:text-white::selection {
            --tw-text-opacity: 1;
            color: rgb(255 255 255 / var(--tw-text-opacity))
        }

        .hover\:text-gray-900:hover {
            --tw-text-opacity: 1;
            color: rgb(17 24 39 / var(--tw-text-opacity))
        }

        .hover\:text-gray-700:hover {
            --tw-text-opacity: 1;
            color: rgb(55 65 81 / var(--tw-text-opacity))
        }

        .focus\:rounded-sm:focus {
            border-radius: 0.125rem
        }

        .focus\:outline:focus {
            outline-style: solid
        }

        .focus\:outline-2:focus {
            outline-width: 2px
        }

        .focus\:outline-red-500:focus {
            outline-color: #ef4444
        }

        .group:hover .group-hover\:stroke-gray-600 {
            stroke: #4b5563
        }

        @media (prefers-reduced-motion: no-preference) {
            .motion-safe\:hover\:scale-\[1\.01\]:hover {
                --tw-scale-x: 1.01;
                --tw-scale-y: 1.01;
                transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))
            }
        }

        @media (prefers-color-scheme: dark) {
            .dark\:bg-gray-900 {
                --tw-bg-opacity: 1;
                background-color: rgb(17 24 39 / var(--tw-bg-opacity))
            }

            .dark\:bg-gray-800\/50 {
                background-color: rgb(31 41 55 / 0.5)
            }

            .dark\:bg-red-800\/20 {
                background-color: rgb(153 27 27 / 0.2)
            }

            .dark\:bg-dots-lighter {
                background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E")
            }

            .dark\:bg-gradient-to-bl {
                background-image: linear-gradient(to bottom left, var(--tw-gradient-stops))
            }

            .dark\:stroke-gray-600 {
                stroke: #4b5563
            }

            .dark\:text-gray-400 {
                --tw-text-opacity: 1;
                color: rgb(156 163 175 / var(--tw-text-opacity))
            }

            .dark\:text-white {
                --tw-text-opacity: 1;
                color: rgb(255 255 255 / var(--tw-text-opacity))
            }

            .dark\:shadow-none {
                --tw-shadow: 0 0 #0000;
                --tw-shadow-colored: 0 0 #0000;
                box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)
            }

            .dark\:ring-1 {
                --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
                --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);
                box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)
            }

            .dark\:ring-inset {
                --tw-ring-inset: inset
            }

            .dark\:ring-white\/5 {
                --tw-ring-color: rgb(255 255 255 / 0.05)
            }

            .dark\:hover\:text-white:hover {
                --tw-text-opacity: 1;
                color: rgb(255 255 255 / var(--tw-text-opacity))
            }

            .group:hover .dark\:group-hover\:stroke-gray-400 {
                stroke: #9ca3af
            }
        }

        @media (min-width: 640px) {
            .sm\:fixed {
                position: fixed
            }

            .sm\:top-0 {
                top: 0px
            }

            .sm\:right-0 {
                right: 0px
            }

            .sm\:ml-0 {
                margin-left: 0px
            }

            .sm\:flex {
                display: flex
            }

            .sm\:items-center {
                align-items: center
            }

            .sm\:justify-center {
                justify-content: center
            }

            .sm\:justify-between {
                justify-content: space-between
            }

            .sm\:text-left {
                text-align: left
            }

            .sm\:text-right {
                text-align: right
            }
        }

        @media (min-width: 768px) {
            .md\:grid-cols-2 {
                grid-template-columns:repeat(2, minmax(0, 1fr))
            }
        }

        @media (min-width: 1024px) {
            .lg\:gap-8 {
                gap: 2rem
            }

            .lg\:p-8 {
                padding: 2rem
            }
        }
    </style>
</head>
<body class="antialiased">
<div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 selection:bg-red-500 selection:text-white">
    @if (Route::has('login'))
        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
            @auth
                <a href="{{ route('web.perfil') }}"
                   class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">{{ __('Profile') }}</a>
                {{--<a href="{{ route('chat.directo') }}"
                   class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                   target="_blank">Chat Directo</a>--}}
                <a href="{{ url('/dashboard') }}"
                   class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
            @else
                <a href="{{ route('login') }}"
                   class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 mr-2">{{ __('Log in') }}</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                       class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">{{ __('Register') }}</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <div class="flex justify-center">
            {{--<svg viewBox="0 0 62 65" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-16 w-auto bg-gray-100">
                <path d="M61.8548 14.6253C61.8778 14.7102 61.8895 14.7978 61.8897 14.8858V28.5615C61.8898 28.737 61.8434 28.9095 61.7554 29.0614C61.6675 29.2132 61.5409 29.3392 61.3887 29.4265L49.9104 36.0351V49.1337C49.9104 49.4902 49.7209 49.8192 49.4118 49.9987L25.4519 63.7916C25.3971 63.8227 25.3372 63.8427 25.2774 63.8639C25.255 63.8714 25.2338 63.8851 25.2101 63.8913C25.0426 63.9354 24.8666 63.9354 24.6991 63.8913C24.6716 63.8838 24.6467 63.8689 24.6205 63.8589C24.5657 63.8389 24.5084 63.8215 24.456 63.7916L0.501061 49.9987C0.348882 49.9113 0.222437 49.7853 0.134469 49.6334C0.0465019 49.4816 0.000120578 49.3092 0 49.1337L0 8.10652C0 8.01678 0.0124642 7.92953 0.0348998 7.84477C0.0423783 7.8161 0.0598282 7.78993 0.0697995 7.76126C0.0884958 7.70891 0.105946 7.65531 0.133367 7.6067C0.152063 7.5743 0.179485 7.54812 0.20192 7.51821C0.230588 7.47832 0.256763 7.43719 0.290416 7.40229C0.319084 7.37362 0.356476 7.35243 0.388883 7.32751C0.425029 7.29759 0.457436 7.26518 0.498568 7.2415L12.4779 0.345059C12.6296 0.257786 12.8015 0.211853 12.9765 0.211853C13.1515 0.211853 13.3234 0.257786 13.475 0.345059L25.4531 7.2415H25.4556C25.4955 7.26643 25.5292 7.29759 25.5653 7.32626C25.5977 7.35119 25.6339 7.37362 25.6625 7.40104C25.6974 7.43719 25.7224 7.47832 25.7523 7.51821C25.7735 7.54812 25.8021 7.5743 25.8196 7.6067C25.8483 7.65656 25.8645 7.70891 25.8844 7.76126C25.8944 7.78993 25.9118 7.8161 25.9193 7.84602C25.9423 7.93096 25.954 8.01853 25.9542 8.10652V33.7317L35.9355 27.9844V14.8846C35.9355 14.7973 35.948 14.7088 35.9704 14.6253C35.9792 14.5954 35.9954 14.5692 36.0053 14.5405C36.0253 14.4882 36.0427 14.4346 36.0702 14.386C36.0888 14.3536 36.1163 14.3274 36.1375 14.2975C36.1674 14.2576 36.1923 14.2165 36.2272 14.1816C36.2559 14.1529 36.292 14.1317 36.3244 14.1068C36.3618 14.0769 36.3942 14.0445 36.4341 14.0208L48.4147 7.12434C48.5663 7.03694 48.7383 6.99094 48.9133 6.99094C49.0883 6.99094 49.2602 7.03694 49.4118 7.12434L61.3899 14.0208C61.4323 14.0457 61.4647 14.0769 61.5021 14.1055C61.5333 14.1305 61.5694 14.1529 61.5981 14.1803C61.633 14.2165 61.6579 14.2576 61.6878 14.2975C61.7103 14.3274 61.7377 14.3536 61.7551 14.386C61.7838 14.4346 61.8 14.4882 61.8199 14.5405C61.8312 14.5692 61.8474 14.5954 61.8548 14.6253ZM59.893 27.9844V16.6121L55.7013 19.0252L49.9104 22.3593V33.7317L59.8942 27.9844H59.893ZM47.9149 48.5566V37.1768L42.2187 40.4299L25.953 49.7133V61.2003L47.9149 48.5566ZM1.99677 9.83281V48.5566L23.9562 61.199V49.7145L12.4841 43.2219L12.4804 43.2194L12.4754 43.2169C12.4368 43.1945 12.4044 43.1621 12.3682 43.1347C12.3371 43.1097 12.3009 43.0898 12.2735 43.0624L12.271 43.0586C12.2386 43.0275 12.2162 42.9888 12.1887 42.9539C12.1638 42.9203 12.1339 42.8916 12.114 42.8567L12.1127 42.853C12.0903 42.8156 12.0766 42.7707 12.0604 42.7283C12.0442 42.6909 12.023 42.656 12.013 42.6161C12.0005 42.5688 11.998 42.5177 11.9931 42.4691C11.9881 42.4317 11.9781 42.3943 11.9781 42.3569V15.5801L6.18848 12.2446L1.99677 9.83281ZM12.9777 2.36177L2.99764 8.10652L12.9752 13.8513L22.9541 8.10527L12.9752 2.36177H12.9777ZM18.1678 38.2138L23.9574 34.8809V9.83281L19.7657 12.2459L13.9749 15.5801V40.6281L18.1678 38.2138ZM48.9133 9.14105L38.9344 14.8858L48.9133 20.6305L58.8909 14.8846L48.9133 9.14105ZM47.9149 22.3593L42.124 19.0252L37.9323 16.6121V27.9844L43.7219 31.3174L47.9149 33.7317V22.3593ZM24.9533 47.987L39.59 39.631L46.9065 35.4555L36.9352 29.7145L25.4544 36.3242L14.9907 42.3482L24.9533 47.987Z"
                      fill="#FF2D20"/>
            </svg>--}}
            <svg class="w-20 h-20" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="171px" height="171px" viewBox="0 0 171 171" enable-background="new 0 0 171 171" xml:space="preserve">  <image id="image0" width="171" height="171" x="0" y="0"
                                                                                                                                                                                                                                                                                 href="data:image/png;base64,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
e+vQww56+cgjDn72gEnDWj/Qi92HKQvL2pN5r2frX5n12iFr12wcnndySd/DzGTd1K7HlXY8AUgp
1W5e3/0F2YMwd8c7WswilZWVnUIIpJTKMAzfMAxlGIYvpVRCCKZOHTersirVWVfXr2XyhESfyc/V
1yg7sUb899LnZwMiIkpEYo0oGyKxRpQNkVgjyoZIrBFlQyTWiLIhEmtE2RCJNaJsiMQaUTZEYo0o
GyKxRpQNkVgjyoZIrBFlQyTWiLIhEmtE2RCJNaJsiMQaUTZEYo0oGyKxRpQNkVgjyoZIrBFlQyTW
iLIhEmtE2RCJNaJsiMQaUTZEYo0oGyKxRpQNkVgjyoZIrBFlQyTWiLIhEmtE2RCJNaJsiMQaUTZE
Yo0oGyKxRpQNkVgjyoZIrBFlQyTWiLIhEmtE2RCJNaJsiMQaUTZEYo0oGyKxRpQNkVgjyoZIrBFl
QyTWiLIhEmtE2fD/A2zXLQFR3aiZAAAAJXRFWHRkYXRlOmNyZWF0ZQAyMDIzLTAyLTI1VDE4OjI3
OjEyKzAxOjAwcQBm4wAAACV0RVh0ZGF0ZTptb2RpZnkAMjAyMy0wMi0yNVQxODoyNzoxMiswMTow
MABd3l8AAAA3dEVYdGljYzpjb3B5cmlnaHQAQ29weXJpZ2h0IDE5OTkgQWRvYmUgU3lzdGVtcyBJ
bmNvcnBvcmF0ZWQxbP9tAAAAIHRFWHRpY2M6ZGVzY3JpcHRpb24AQWRvYmUgUkdCICgxOTk4KbC6
6vYAAAAASUVORK5CYII=" />
</svg>

        </div>

        {{--<div class="mt-16">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                <a href="https://laravel.com/docs"
                   class="scale-100 p-6 bg-white from-gray-700/50 via-transparent rounded-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                    <div>
                        <div class="h-16 w-16 bg-red-50 flex items-center justify-center rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 class="w-7 h-7 stroke-red-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                            </svg>
                        </div>

                        <h2 class="mt-6 text-xl font-semibold text-gray-900">Documentation</h2>

                        <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                            Laravel has wonderful documentation covering every aspect of the framework. Whether you are
                            a newcomer or have prior experience with Laravel, we recommend reading our documentation
                            from beginning to end.
                        </p>
                    </div>

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         class="self-center shrink-0 stroke-red-500 w-6 h-6 mx-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/>
                    </svg>
                </a>

                <a href="https://laracasts.com"
                   class="scale-100 p-6 bg-white from-gray-700/50 via-transparent rounded-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                    <div>
                        <div class="h-16 w-16 bg-red-50 flex items-center justify-center rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 class="w-7 h-7 stroke-red-500">
                                <path stroke-linecap="round"
                                      d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z"/>
                            </svg>
                        </div>

                        <h2 class="mt-6 text-xl font-semibold text-gray-900">Laracasts</h2>

                        <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                            Laracasts offers thousands of video tutorials on Laravel, PHP, and JavaScript development.
                            Check them out, see for yourself, and massively level up your development skills in the
                            process.
                        </p>
                    </div>

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         class="self-center shrink-0 stroke-red-500 w-6 h-6 mx-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/>
                    </svg>
                </a>

                <a href="https://laravel-news.com"
                   class="scale-100 p-6 bg-white from-gray-700/50 via-transparent rounded-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                    <div>
                        <div class="h-16 w-16 bg-red-50 flex items-center justify-center rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 class="w-7 h-7 stroke-red-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z"/>
                            </svg>
                        </div>

                        <h2 class="mt-6 text-xl font-semibold text-gray-900">Laravel News</h2>

                        <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                            Laravel News is a community driven portal and newsletter aggregating all of the latest and
                            most important news in the Laravel ecosystem, including new package releases and tutorials.
                        </p>
                    </div>

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         class="self-center shrink-0 stroke-red-500 w-6 h-6 mx-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/>
                    </svg>
                </a>

                <div class="scale-100 p-6 bg-white from-gray-700/50 via-transparent rounded-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                    <div>
                        <div class="h-16 w-16 bg-red-50 flex items-center justify-center rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 class="w-7 h-7 stroke-red-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M6.115 5.19l.319 1.913A6 6 0 008.11 10.36L9.75 12l-.387.775c-.217.433-.132.956.21 1.298l1.348 1.348c.21.21.329.497.329.795v1.089c0 .426.24.815.622 1.006l.153.076c.433.217.956.132 1.298-.21l.723-.723a8.7 8.7 0 002.288-4.042 1.087 1.087 0 00-.358-1.099l-1.33-1.108c-.251-.21-.582-.299-.905-.245l-1.17.195a1.125 1.125 0 01-.98-.314l-.295-.295a1.125 1.125 0 010-1.591l.13-.132a1.125 1.125 0 011.3-.21l.603.302a.809.809 0 001.086-1.086L14.25 7.5l1.256-.837a4.5 4.5 0 001.528-1.732l.146-.292M6.115 5.19A9 9 0 1017.18 4.64M6.115 5.19A8.965 8.965 0 0112 3c1.929 0 3.716.607 5.18 1.64"/>
                            </svg>
                        </div>

                        <h2 class="mt-6 text-xl font-semibold text-gray-900">Vibrant Ecosystem</h2>

                        <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                            Laravel's robust library of first-party tools and libraries, such as <a
                                    href="https://forge.laravel.com"
                                    class="underline hover:text-gray-700 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Forge</a>,
                            <a href="https://vapor.laravel.com"
                               class="underline hover:text-gray-700 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Vapor</a>,
                            <a href="https://nova.laravel.com"
                               class="underline hover:text-gray-700 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Nova</a>,
                            and <a href="https://envoyer.io"
                                   class="underline hover:text-gray-700 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Envoyer</a>
                            help you take your projects to the next level. Pair them with powerful open source libraries
                            like <a href="https://laravel.com/docs/billing"
                                    class="underline hover:text-gray-700 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Cashier</a>,
                            <a href="https://laravel.com/docs/dusk"
                               class="underline hover:text-gray-700 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dusk</a>,
                            <a href="https://laravel.com/docs/broadcasting"
                               class="underline hover:text-gray-700 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Echo</a>,
                            <a href="https://laravel.com/docs/horizon"
                               class="underline hover:text-gray-700 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Horizon</a>,
                            <a href="https://laravel.com/docs/sanctum"
                               class="underline hover:text-gray-700 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Sanctum</a>,
                            <a href="https://laravel.com/docs/telescope"
                               class="underline hover:text-gray-700 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Telescope</a>,
                            and more.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-center mt-16 px-0 sm:items-center sm:justify-between">
            <div class="text-center text-sm text-gray-500 sm:text-left">
                <div class="flex items-center gap-4">
                    <a href="https://github.com/sponsors/taylorotwell"
                       class="group inline-flex items-center hover:text-gray-700 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             class="-mt-px mr-1 w-5 h-5 stroke-gray-400 group-hover:stroke-gray-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/>
                        </svg>
                        Sponsor
                    </a>
                </div>
            </div>

            <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})<br>
                {{ hola() }}
            </div>
        </div>--}}
    </div>
</div>
</body>
@include('sweetalert::alert')
</html>
