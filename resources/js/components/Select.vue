<template>
    <select class="dark:bg-gray-900 dark:border-transparent dark:text-gray-300 py-1 px-3 focus:outline-none border border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="select">
        <slot></slot>
    </select>
</template>

<script>
    export default {
        name: 'VSelect',

        props: ['modelValue'],

        emits: ['update:modelValue'],

        methods: {
            focus() {
                this.$refs.input.focus()
            }
        }
    }
</script>

