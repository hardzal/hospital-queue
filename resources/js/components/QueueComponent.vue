<template>
    <div>
        <div class="alert alert-info p-5 text-center">
            <h1>No Antrian : {{ queue.position }}</h1>
            <h2>{{ queue.code + queue.position }}</h2>
            <h3>{{ queue.polyclinic.name }}</h3>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            queue: null,
        }
    },
    mounted() {
        Echo.channel('queue.updated')
            .listen('QueueUpdated', (e) => {
                this.queue = e.queue;
            })
    },
}
</script>
