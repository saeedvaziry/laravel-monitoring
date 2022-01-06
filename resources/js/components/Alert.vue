<template>
    <div class="inline-flex">
        <a href="javascript:" class="text-indigo-500 font-bold" @click="modal = true">Alerts</a>
        <v-dialog-form max-width="xl" :show="modal" @close="modal = false">
            <template #title>Configure alert for {{ alert.instance_name }}</template>
            <template #form>
                <div class="col-span-6">
                    <v-label for="cpu" value="CPU over than" />
                    <v-input id="cpu" type="text" class="mt-1 block w-full" v-model="form.cpu" ref="cpu" autocomplete="cpu" placeholder="50" />
                    <v-input-error :message="errors && errors.cpu ? errors.cpu[0] : ''" class="mt-2" />
                </div>
                <div class="col-span-6">
                    <v-label for="memory" value="Memory over than" />
                    <v-input id="memory" type="text" class="mt-1 block w-full" v-model="form.memory" ref="memory" autocomplete="memory" placeholder="50" />
                    <v-input-error :message="errors && errors.memory ? errors.memory[0] : ''" class="mt-2" />
                </div>
                <div class="col-span-6">
                    <v-label for="disk" value="Disk over than" />
                    <v-input id="disk" type="text" class="mt-1 block w-full" v-model="form.disk" ref="disk" autocomplete="disk" placeholder="50" />
                    <v-input-error :message="errors && errors.disk ? errors.disk[0] : ''" class="mt-2" />
                </div>
                <div class="col-span-6">
                    <v-label for="occurred" value="Occurred" />
                    <v-input id="occurred" type="text" class="mt-1 block w-full" v-model="form.occurred" ref="occurred" autocomplete="occurred" disabled />
                </div>
            </template>
            <template #actions>
                <div class="flex items-center justify-between">
                    <div>
                        <span v-if="saved" class="text-gray-500">Saved!</span>
                    </div>
                    <div class="flex items-center">
                        <v-secondary-button @click="modal = false">Cancel</v-secondary-button>
                        <v-button class="ml-2" @click="save" :class="{ 'opacity-25': saving }" :disabled="saving">
                            Save
                        </v-button>
                    </div>
                </div>
            </template>
        </v-dialog-form>
    </div>
</template>

<script>
    import axios from "axios";
    import VDialogForm from "@/components/DialogForm";
    import VLabel from "@/components/Label";
    import VInput from "@/components/Input";
    import VInputError from "@/components/InputError";
    import VSecondaryButton from "@/components/SecondaryButton";
    import VButton from "@/components/Button";

    export default {
        name: "VAlert",
        components: {VButton, VSecondaryButton, VInputError, VInput, VLabel, VDialogForm},
        props: {
            alert: {
                type: Object,
                default: {
                    instance_name: '',
                    cpu: '',
                    memory: '',
                    disk: '',
                    occurred: '',
                }
            }
        },
        data() {
            return {
                modal: false,
                saving: false,
                form: this.alert,
                errors: {},
                saved: false,
            }
        },
        methods: {
            save() {
                this.saving = true;
                axios.post('/monitoring/alerts', this.form).then((res) => {
                    this.form = res.data.alert;
                    this.errors = {};
                    this.saved = true;
                    setTimeout(() => {
                        this.saved = false;
                    }, 2000);
                }).catch((err) => {
                    this.errors = err.response.data.errors;
                }).then(() => {
                    this.saving = false;
                })
            }
        },
    }
</script>
