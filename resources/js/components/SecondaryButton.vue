<template>
    <button :type="type" class="w-max inline-flex items-center px-4 py-1 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-800 rounded-md font-semibold text-gray-700 dark:text-gray-300 shadow-sm hover:text-gray-500 focus:outline-none focus:border-indigo-300 focus:ring focus:ring-indigo-200 disabled:opacity-25 transition">
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
