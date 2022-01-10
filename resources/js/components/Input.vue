<template>
    <input class="py-2 px-3 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-700 focus:outline-none border border-gray-300 focus:ring focus:ring-indigo-300 focus:border-gray-400 focus:ring-opacity-50 rounded-md shadow-sm disabled:bg-gray-100 dark:disabled:bg-gray-700 mt-1 block w-full" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input">
</template>

<script>
    export default {
        name: 'VInput',

        props: ['modelValue', 'value'],

        mounted() {
            if (this.value) {
                this.$emit('update:modelValue', this.value)
            }
        },

        emits: ['update:modelValue'],

        methods: {
            focus() {
                this.$refs.input.focus()
            }
        }
    }
</script>

