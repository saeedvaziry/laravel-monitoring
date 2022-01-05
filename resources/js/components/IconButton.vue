<template>
    <button :type="type" class="inline-flex items-center p-2 bg-indigo-600 hover:bg-indigo-700 rounded-md font-semibold text-white capitalize shadow-sm focus:outline-none focus:ring focus:ring-blue-200 disabled:opacity-25 transition" @click="$emit('click', $event)">
        <slot></slot>
    </button>
</template>

<script>
    export default {
        name: 'IconButton',

        props: {
            type: {
                type: String,
                default: 'button',
            },
        }
    }
</script>
