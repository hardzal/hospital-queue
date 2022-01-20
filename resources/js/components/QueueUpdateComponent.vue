<template>
    <div class="row">
        <div class="col-lg-4 text-center">
            <form @submit.prevent="updateQueue">
                <input type="hidden" name="_token" :value="csrf">
                <input type="hidden" name="current_position" value=0 v-model="current_position"/>
                <input type="hidden" name="status" value=2 v-model="status"/>
                <input type="hidden" name="type" value="prev" v-model="type"/>
                <button type="submit">
                    <i class="fas fa-arrow-circle-left"></i>
                </button>
            </form>
        </div>
        <div class="col-lg-4 text-center">
            <button type="submit" class="btn btn-primary" style="display:inline;" id="call">CALL</button>
            <form @submit.prevent="updateQueue"
                style="display:inline!important;">
                <input type="hidden" name="current_position" value=0 v-model="current_position"/>
                <input type="hidden" name="status" value=0 v-model="status"/>
                <input type="hidden" name="type" value="skip" v-model="type"/>
                <input type="hidden" name="_token" :value="csrf">
                <button type="submit" class="btn btn-secondary" style="display:inline;">
                    SKIP
                </button>
            </form>
        </div>
        <div class="col-lg-4 text-center">
            <form @submit.prevent="updateQueue">
                <input type="hidden" name="_token" :value="csrf">
                <input type="hidden" name="current_position" value=0 v-model="current_position"/>
                <input type="hidden" name="status" value=2 v-model="status"/>
                <input type="hidden" name="type" value="next" v-model="type"/>
                <button type="submit">
                    <i class="fas fa-arrow-circle-right"></i>
                </button>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            status: '',
            current_position: '',
            type: '',
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    },
    props: ['queueId', 'link'],
    methods: {
        updateQueue() {
            axios.post(`/queue/{queueId}`, {
                status: this.status,
                current_position: this.current_position,
                type: this.type,
            }).then((response) => {

            }).catch(error => {
                console.log(error);
            });
        },
    }
}
</script>
