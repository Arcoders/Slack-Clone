<template>
    <div class="container">
        <p class="text-center" v-if="loading">
            Loading
        </p>
        <p class="text-center" v-if="!loading">
            <button @click="add_friend" class="btn btn-success" v-if="status == 0">Add Friend</button>
            <button @click="accept_friend" class="btn btn-info" v-if="status == 'pending'">Accept Friend</button>
            <span class="text-success" v-if="status == 'waiting'">Waiting for response</span>
            <span class="text-success" v-if="status == 'friends'">Friends</span>
        </p>
    </div>
</template>

<script>
    export default {
        props: ['my_id', 'profile_user_id'],
        data() {
            return {
                status: '',
                loading: true,
                changeStatus: []
            }
        },
        mounted() {
            this.relationShipStatus();
            this.updtateStatus();
        },
        methods: {
            updtateStatus() {
                this.channel = this.$pusher.subscribe('user' + this.my_id);
                this.channel.bind('updateStatus', (data) => {
                    this.relationShipStatus();
                });
            },
            relationShipStatus() {
                this.$http.get('/check_relationship_status/'+this.profile_user_id).then(response => {

                    if (response.status == 200) {
                        this.status = response.body.status;
                        this.loading = false;
                    } else {
                        // ...
                    }

                }, response => {
                    // ...
                });
            },
            add_friend() {
                this.loading = true;
                this.$http.get('/add_friend/'+this.profile_user_id).then(response => {

                    if (response.status == 200) {

                        if (response.body == 1) this.status = 'waiting';
                        if (response.body == 0) this.status = 0;

                        this.loading = false;

                    } else {
                        // ...
                    }

                }, response => {
                    // ...
                });
            },
            accept_friend() {
                this.loading = true;
                this.$http.get('/accept_friend/'+this.profile_user_id).then(response => {

                    if (response.status == 200) {

                        if (response.body == 1) this.status = 'friends';
                        if (response.body == 0) this.status = 'pending';

                        this.loading = false;

                    } else {
                        // ...
                    }

                }, response => {
                    // ...
                });
            }
        }
    }
</script>
