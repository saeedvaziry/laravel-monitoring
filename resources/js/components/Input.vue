<template>
    <input class="py-2 px-3 focus:outline-none border border-gray-300 focus:ring focus:ring-indigo-300 focus:border-gray-400 focus:ring-opacity-50 rounded-md shadow-sm disabled:bg-gray-100 mt-1 block w-full" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input">
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

