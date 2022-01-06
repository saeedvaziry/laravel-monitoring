<template>
    <button :type="type" class="inline-flex items-center p-2 bg-indigo-700 rounded-md font-semibold text-white capitalize shadow-sm focus:outline-none focus:ring focus:ring-indigo-200 disabled:opacity-25 transition">
        <slot></slot>
    </button>
</template>

<script>
    export default {
        name: 'VIconButton',

        props: {
            type: {
                type: String,
                default: 'button',
            },
        }
    }
</script>
