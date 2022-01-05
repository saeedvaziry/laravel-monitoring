import Vue from 'vue';

Vue.component('app', require('./components/App').default);
Vue.component('loader', require('./components/Loader').default);
Vue.component('icon-button', require('./components/IconButton').default);
Vue.component('usage', require('./components/Usage').default);

new Vue({
    el: '#app',
    data() {
        return {};
    },
    mounted() {},
    methods: {},
});
