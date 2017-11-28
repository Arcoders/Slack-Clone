<template>
    <div id="all_messages">
        <ul class="messages">
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
        props: ['all_messages'],
        data() {
            return {
                currentUser: ''
            }
        },
        created() {
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
</script>