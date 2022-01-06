require('./bootstrap');

// window.Vue = require('vue');
import Vue from 'vue'
// import Coba from './components/Coba.vue'
import QueueComponent from './components/QueueComponent.vue';
import QueueUpdateComponent from './components/QueueUpdateComponent.vue';

Vue.component('queue-component', require('./components/QueueComponent.vue').default);
Vue.component('queue-update-component', require('./components/QueueUpdateComponent.vue').default);
// Vue.component('coba', require("./components/Coba.vue").default);

const app = new Vue({
    el: '#app',
    created() {
        Echo.private('queue.updated')
            .listen('QueueUpdated', (e) => {
                alert('Antrian telah terupdate!');
                // console.log(e.post.title)
                console.log("Antrian selanjutnya!")
            });
    },
    components: {
        QueueComponent,
        QueueUpdateComponent,
    }
});
