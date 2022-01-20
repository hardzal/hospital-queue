<template>
        <div class="alert alert-primary p-5 text-center d-table-cell align-middle" style="height: 400px">
            <h1>No Antrian : {{ queue.queue_position }}</h1>
            <h2><strong>{{ queue.polyclinic.code }}{{ queue.queue_position }}</strong></h2>
            <h3>{{ data.polyclinic.name }}</h3>
        </div>
</template>
<script>
export default {
    data() {
        return {
            queue: this.data,
        };
    },
    props: ["data"],
    mounted() {
        Echo.channel("queue.updated").listen("QueueUpdated", (e) => {
            this.queue = e.queue;
        });
    },
    created() {
        // console.log(this.data);
    },
};
</script>
