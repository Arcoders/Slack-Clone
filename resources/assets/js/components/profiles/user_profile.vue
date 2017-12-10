<template>
    <div v-if="load" class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <h4>{{ profileUserName }}</h4>
                    </div>

                    <div class="panel-body">
                        <avatar :username="profileUserName"
                                color="#fff"
                                class="avatar"
                                :src="image"
                                :size="100">
                        </avatar>
                    </div>
                    <div v-if="currentUserId != user_id"  class="panel-footer">
                        <friend :my_id="currentUserId" :profile_user_id="user_id"></friend>
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
                profileUserName: '',
                currentUserId: '',
                user_id: this.$route.params.user_id,
                load: false
            }
        },
        created() {
            this.getCurrentUser();
            this.getProfileUser();
        },
        methods: {
            getProfileUser() {
                this.$http.get('/getProfile/'+this.user_id).then(response => {

                    if (response.status == 200) {
                        this.profileUserName = response.body.name;
                        this.image = response.body.avatar;
                    } else {
                        // ...
                    }

                }, response => {
                    // ...
                });
            },
            getCurrentUser() {
                this.$http.get('/getCurrentUser').then(response => {

                    if (response.status == 200) {
                        this.currentUserId = response.body.id;
                        this.load = true;
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
