<template>
    <div class="container">
        ...
    </div>
</template>

<script>
    export default {
        props: ['profile_user_id'],
        mounted() {
            this.relationShipStatus();
        },
        methods: {
            relationShipStatus() {
                this.$http.get('/check_relationship_status/'+this.profile_user_id).then(response => {

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
