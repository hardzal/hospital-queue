require('./bootstrap');

window.Vue = require('vue');

Vue.component('queue-component', require('./components/QueueComponent.vue').default);

const app = new Vue({
    el: '#app',
    created() {
        Echo.private('queue.updated')
            .listen('QueueUpdated', (e) => {
                alert(e.post.title + 'Has been updated now');
                // console.log(e.post.title)
                console.log("Antrian selanjutnya!")
            });
    }
});
