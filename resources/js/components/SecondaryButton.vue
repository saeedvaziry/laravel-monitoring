<template>
    <button :type="type" class="w-max inline-flex items-center px-4 py-1 bg-white border border-gray-300 rounded-md font-semibold text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition">
        <slot></slot>
    </button>
</template>

<script>
    export default {
        name: 'VSecondaryButton',

        props: {
            type: {
                type: String,
                default: 'button',
            },
        }
    }
</script>
