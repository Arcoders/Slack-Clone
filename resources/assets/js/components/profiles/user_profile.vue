<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>{{ currentUserName }}</h4>
                    </div>

                    <div class="panel-body">
                        <avatar :username="currentUserName"
                                color="#fff"
                                class="avatar"
                                :src="image"
                                :size="100">
                        </avatar>
                    </div>
                    <div class="panel-footer">
                        <friend></friend>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
    img{
        height: 100px;
        width: 100px;
        border-radius: 50%;
    }
</style>
<script>
    import friend from '../users/friend.vue';
    export default{
        components: {
            friend: friend
        },
        data(){
            return {
                image: null,
                currentUserName: '',
                user_id: this.$route.params.user_id
            }
        },
        created() {
            this.getCurrentUser();
        },
        methods: {
            getCurrentUser() {
                this.$http.get('/getProfile/'+this.user_id).then(response => {

                    if (response.status == 200) {
                        this.currentUserName = response.body.name;
                        this.image = response.body.avatar;
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
