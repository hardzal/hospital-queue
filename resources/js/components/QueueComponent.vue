<template>
    <div>
        <div class="alert alert-info p-5 text-center">
            <h1>No Antrian : {{ queue.queue_position }}</h1>
            <h2>{{ queue.queue_position }}</h2>
            <h3>{{ data.polyclinic.name }}</h3>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            queue: this.data,
        }
    },
    props: ['data'],
    mounted() {
        Echo.channel('queue.updated')
            .listen('QueueUpdated', (e) => {
                this.queue = e.queue;
            })
    },
    created() {
        console.log(this.data);
    },
}
</script>
