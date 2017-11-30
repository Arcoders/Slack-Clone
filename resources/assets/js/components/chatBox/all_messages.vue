<template>
    <div id="all_messages">
        <ul class="messages">

            <li v-for="last in latest"
                class="message appeared"
                v-bind:class="{ 'right': last.user.id == currentUser,
                                'left': last.user.id != currentUser
                               }">
                <div class="avatar"></div>
                <div class="text_wrapper">
                    <div class="text">
                        <b>{{ last.user.name }}</b>
                        <br>
                        {{ last.body }}
                        <small class="small pull-right">
                            <b> {{ last.created_at }} </b>
                        </small>
                    </div>
                </div>
            </li>

            <li v-for="message in all_messages"
                class="message appeared"
                v-bind:class="{ 'right': message.user.id == currentUser,
                                'left': message.user.id != currentUser
                               }">
                <div class="avatar"></div>
                <div class="text_wrapper">
                    <div class="text">
                        <b>{{ message.user.name }}</b>
                        <br>
                        {{ message.body }}
                        <small class="small pull-right">
                           <b> {{ message.created_at }} </b>
                        </small>
                    </div>
                </div>
            </li>

        </ul>
    </div>
</template>

<script>
    export default {
        props: ['all_messages', 'latest', 'typing'],
        data() {
            return {
                currentUser: ''
            }
        },
        created() {
            this.getCurrentUser();
        },
        mounted() {
//            console.log(this.typing);
        },
        methods: {
            getCurrentUser() {
                this.$http.get('/getCurrentUser').then(response => {

                    if (response.status == 200) {
                        this.currentUser = response.body;
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