<template>
    <div v-show="message">
        <p class="text-sm text-red-600">
            {{ message }}
        </p>
    </div>
</template>

<script>
    export default {
        name: 'VInputError',

        props: ['message']
    }
</script>
