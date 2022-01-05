<template>
    <span
        :class="{
            'text-green-600': parseFloat(value) < 30,
            'text-yellow-600': parseFloat(value) >= 30 && parseFloat(value) < 70,
            'text-red-600': parseFloat(value) >= 70
        }"
    >{{ value }}%
    </span>
</template>

<script>
    export default {
        name: "Usage",
        props: {
            value: Number
        }
    }
</script>
