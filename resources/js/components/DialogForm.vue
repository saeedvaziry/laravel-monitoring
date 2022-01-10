<template>
    <modal :show="show" :max-width="maxWidth" :closeable="closeable" @close="close">
        <div class="px-6 py-4">
            <div class="text-lg dark:text-gray-300">
                <slot name="title">
                </slot>
            </div>

            <div class="mt-4">
                <form @submit.prevent="$emit('submitted')">
                    <div class="grid grid-cols-6 gap-6">
                        <slot name="form">
                        </slot>
                    </div>
                </form>
            </div>
        </div>

        <div class="px-6 py-4 bg-gray-100 dark:bg-gray-700 text-right">
            <slot name="actions"></slot>
        </div>
    </modal>
</template>

<script>
    import Modal from './Modal'

    export default {
        name: 'VDialogForm',

        emits: ['close', 'submitted'],

        components: {
            Modal,
        },

        props: {
            show: {
                default: false
            },
            maxWidth: {
                default: '2xl'
            },
            closeable: {
                default: true
            },
        },

        methods: {
            close() {
                this.$emit('close')
            },
        }
    }
</script>
