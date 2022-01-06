<template>
    <div class="w-full min-h-screen">
        <div v-if="loaded">
            <div class="bg-white shadow">
                <div class="max-w-5xl flex items-center justify-between mx-auto py-7 px-5">
                    <h2 class="text-2xl">Monitoring Dashboard</h2>
                    <div class="flex items-center">
                        <v-select class="mr-2" v-model="duration">
                            <option value="hour">Hour</option>
                            <option value="day" disabled>Day</option>
                        </v-select>
                        <v-icon-button type="button" @click="getData" :class="{'opacity-50': loading}" :disabled="loading">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="sync-alt" class="w-4 h-4 fill-current text-white" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M370.72 133.28C339.458 104.008 298.888 87.962 255.848 88c-77.458.068-144.328 53.178-162.791 126.85-1.344 5.363-6.122 9.15-11.651 9.15H24.103c-7.498 0-13.194-6.807-11.807-14.176C33.933 94.924 134.813 8 256 8c66.448 0 126.791 26.136 171.315 68.685L463.03 40.97C478.149 25.851 504 36.559 504 57.941V192c0 13.255-10.745 24-24 24H345.941c-21.382 0-32.09-25.851-16.971-40.971l41.75-41.749zM32 296h134.059c21.382 0 32.09 25.851 16.971 40.971l-41.75 41.75c31.262 29.273 71.835 45.319 114.876 45.28 77.418-.07 144.315-53.144 162.787-126.849 1.344-5.363 6.122-9.15 11.651-9.15h57.304c7.498 0 13.194 6.807 11.807 14.176C478.067 417.076 377.187 504 256 504c-66.448 0-126.791-26.136-171.315-68.685L48.97 471.03C33.851 486.149 8 475.441 8 454.059V320c0-13.255 10.745-24 24-24z"></path></svg>
                        </v-icon-button>
                    </div>
                </div>
            </div>
            <div class="max-w-5xl mx-auto py-7 px-5">
                <div class="mb-10" v-for="(instance, i) in instances" :key="`instance-${i}`">
                    <div class="grid grid-cols-4 gap-3">
                        <div class="col-span-1 mr-5">
                            <div class="bg-white rounded-md shadow p-3 flex items-center justify-between">
                                <svg class="fill-current text-indigo-600 w-8 h-8" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="server" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M480 160H32c-17.673 0-32-14.327-32-32V64c0-17.673 14.327-32 32-32h448c17.673 0 32 14.327 32 32v64c0 17.673-14.327 32-32 32zm-48-88c-13.255 0-24 10.745-24 24s10.745 24 24 24 24-10.745 24-24-10.745-24-24-24zm-64 0c-13.255 0-24 10.745-24 24s10.745 24 24 24 24-10.745 24-24-10.745-24-24-24zm112 248H32c-17.673 0-32-14.327-32-32v-64c0-17.673 14.327-32 32-32h448c17.673 0 32 14.327 32 32v64c0 17.673-14.327 32-32 32zm-48-88c-13.255 0-24 10.745-24 24s10.745 24 24 24 24-10.745 24-24-10.745-24-24-24zm-64 0c-13.255 0-24 10.745-24 24s10.745 24 24 24 24-10.745 24-24-10.745-24-24-24zm112 248H32c-17.673 0-32-14.327-32-32v-64c0-17.673 14.327-32 32-32h448c17.673 0 32 14.327 32 32v64c0 17.673-14.327 32-32 32zm-48-88c-13.255 0-24 10.745-24 24s10.745 24 24 24 24-10.745 24-24-10.745-24-24-24zm-64 0c-13.255 0-24 10.745-24 24s10.745 24 24 24 24-10.745 24-24-10.745-24-24-24z"></path></svg>
                                <div class="text-lg">{{ instance }}</div>
                            </div>
                            <div class="bg-white rounded-md shadow p-3 flex items-center justify-between mt-3">
                                <svg class="fill-current text-gray-500 w-8 h-8" aria-hidden="true" focusable="false" data-prefix="far" data-icon="bell" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M439.39 362.29c-19.32-20.76-55.47-51.99-55.47-154.29 0-77.7-54.48-139.9-127.94-155.16V32c0-17.67-14.32-32-31.98-32s-31.98 14.33-31.98 32v20.84C118.56 68.1 64.08 130.3 64.08 208c0 102.3-36.15 133.53-55.47 154.29-6 6.45-8.66 14.16-8.61 21.71.11 16.4 12.98 32 32.1 32h383.8c19.12 0 32-15.6 32.1-32 .05-7.55-2.61-15.27-8.61-21.71zM67.53 368c21.22-27.97 44.42-74.33 44.53-159.42 0-.2-.06-.38-.06-.58 0-61.86 50.14-112 112-112s112 50.14 112 112c0 .2-.06.38-.06.58.11 85.1 23.31 131.46 44.53 159.42H67.53zM224 512c35.32 0 63.97-28.65 63.97-64H160.03c0 35.35 28.65 64 63.97 64z"></path></svg>
                                <div class="text-lg">
                                    <v-alert :alert="alerts[instance]" :instance="instance" />
                                </div>
                            </div>
                            <div class="bg-white rounded-md shadow p-3 flex items-center justify-between mt-3">
                                <svg class="fill-current text-gray-500 w-8 h-8" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="microchip" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M416 48v416c0 26.51-21.49 48-48 48H144c-26.51 0-48-21.49-48-48V48c0-26.51 21.49-48 48-48h224c26.51 0 48 21.49 48 48zm96 58v12a6 6 0 0 1-6 6h-18v6a6 6 0 0 1-6 6h-42V88h42a6 6 0 0 1 6 6v6h18a6 6 0 0 1 6 6zm0 96v12a6 6 0 0 1-6 6h-18v6a6 6 0 0 1-6 6h-42v-48h42a6 6 0 0 1 6 6v6h18a6 6 0 0 1 6 6zm0 96v12a6 6 0 0 1-6 6h-18v6a6 6 0 0 1-6 6h-42v-48h42a6 6 0 0 1 6 6v6h18a6 6 0 0 1 6 6zm0 96v12a6 6 0 0 1-6 6h-18v6a6 6 0 0 1-6 6h-42v-48h42a6 6 0 0 1 6 6v6h18a6 6 0 0 1 6 6zM30 376h42v48H30a6 6 0 0 1-6-6v-6H6a6 6 0 0 1-6-6v-12a6 6 0 0 1 6-6h18v-6a6 6 0 0 1 6-6zm0-96h42v48H30a6 6 0 0 1-6-6v-6H6a6 6 0 0 1-6-6v-12a6 6 0 0 1 6-6h18v-6a6 6 0 0 1 6-6zm0-96h42v48H30a6 6 0 0 1-6-6v-6H6a6 6 0 0 1-6-6v-12a6 6 0 0 1 6-6h18v-6a6 6 0 0 1 6-6zm0-96h42v48H30a6 6 0 0 1-6-6v-6H6a6 6 0 0 1-6-6v-12a6 6 0 0 1 6-6h18v-6a6 6 0 0 1 6-6z"></path></svg>
                                <div class="text-2xl font-bold">
                                    <v-usage :value="parseFloat(records[instance].cpu)" />
                                </div>
                            </div>
                            <div class="bg-white rounded-md shadow p-3 flex items-center justify-between mt-3">
                                <svg class="fill-current text-gray-500 w-8 h-8" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="memory" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor" d="M640 130.94V96c0-17.67-14.33-32-32-32H32C14.33 64 0 78.33 0 96v34.94c18.6 6.61 32 24.19 32 45.06s-13.4 38.45-32 45.06V320h640v-98.94c-18.6-6.61-32-24.19-32-45.06s13.4-38.45 32-45.06zM224 256h-64V128h64v128zm128 0h-64V128h64v128zm128 0h-64V128h64v128zM0 448h64v-26.67c0-8.84 7.16-16 16-16s16 7.16 16 16V448h128v-26.67c0-8.84 7.16-16 16-16s16 7.16 16 16V448h128v-26.67c0-8.84 7.16-16 16-16s16 7.16 16 16V448h128v-26.67c0-8.84 7.16-16 16-16s16 7.16 16 16V448h64v-96H0v96z"></path></svg>
                                <div class="text-2xl font-bold">
                                    <v-usage :value="parseFloat(records[instance].memory)" />
                                </div>
                            </div>
                            <div class="bg-white rounded-md shadow p-3 flex items-center justify-between mt-3">
                                <svg class="fill-current text-gray-500 w-8 h-8" aria-hidden="true" focusable="false" data-prefix="far" data-icon="save" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M433.941 129.941l-83.882-83.882A48 48 0 0 0 316.118 32H48C21.49 32 0 53.49 0 80v352c0 26.51 21.49 48 48 48h352c26.51 0 48-21.49 48-48V163.882a48 48 0 0 0-14.059-33.941zM272 80v80H144V80h128zm122 352H54a6 6 0 0 1-6-6V86a6 6 0 0 1 6-6h42v104c0 13.255 10.745 24 24 24h176c13.255 0 24-10.745 24-24V83.882l78.243 78.243a6 6 0 0 1 1.757 4.243V426a6 6 0 0 1-6 6zM224 232c-48.523 0-88 39.477-88 88s39.477 88 88 88 88-39.477 88-88-39.477-88-88-88zm0 128c-22.056 0-40-17.944-40-40s17.944-40 40-40 40 17.944 40 40-17.944 40-40 40z"></path></svg>
                                <div class="text-2xl font-bold">
                                    <v-usage :value="parseFloat(records[instance].disk)" />
                                </div>
                            </div>
                        </div>
                        <div class="col-span-3 bg-white rounded-md shadow p-3" style="height: 329px">
                            <canvas :id="`${instance}-chart`" height="304" width="700" class="mx-auto"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-else class="flex items-center justify-center w-full h-full">
            <v-loader class="w-10" />
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import moment from "moment-timezone";
    import Chart from 'chart.js';
    import VIconButton from "@/components/IconButton";
    import VLoader from "@/components/Loader";
    import VAlert from "@/components/Alert";
    import VUsage from "@/components/Usage";
    import VSelect from "@/components/Select";

    export default {
        name: "App",
        components: {VSelect, VUsage, VAlert, VLoader, VIconButton},
        data() {
            return {
                loaded: false,
                loading: false,
                instances: [],
                records: {},
                chartsData: {},
                charts: {},
                alerts: [],
                duration: 'hour'
            }
        },
        mounted() {
            this.getData();
        },
        methods: {
            getData() {
                this.loading = true;
                axios.get(window.app.prefix + '/records?duration=' + this.duration).then((res) => {
                    this.loaded = true;
                    this.instances = res.data.instances;
                    this.records = res.data.records;
                    this.chartsData = res.data.charts;
                    this.alerts = res.data.alerts;
                    setTimeout(() => {
                        this.instances.map((instance) => {
                            this.chartsData[instance].labels.map((value, i) => {
                                this.chartsData[instance].labels[i] = moment(value).tz(moment.tz.guess()).format('hh:mm')
                            });
                            this.generateChart(instance);
                        })
                    }, 100)
                }).then(() => {
                    this.loading = false;
                });
            },
            generateChart(instance) {
                if (this.charts[instance]) {
                    this.charts[instance].destroy();
                }
                let ctx = document.getElementById(instance + '-chart').getContext('2d');
                this.charts[instance] = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: this.chartsData[instance].labels,
                        datasets: this.chartsData[instance].datasets,
                    },
                    options: {
                        responsive: false,
                        scales: {
                            yAxes: [{
                                grid: {
                                    color: '#f1f5f9'
                                },
                                min: 0,
                                max: 100,
                                beginAtZero: true
                            }]
                        }
                    }
                });
            }
        }
    }
</script>
