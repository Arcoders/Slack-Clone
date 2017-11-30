<template>
    <div id="add_messages">

        <div class="bottom_wrapper clearfix">

            <b-alert :show="dismissCountDown"
                     dismissible
                     v-bind:variant="type"
                     @dismissed="dismissCountDown=0"
                     @dismiss-count-down="countDownChanged">

                <b>Error: </b>{{text}} {{dismissCountDown}} seconds...</b>

            </b-alert>

            <div  v-if="!error" class="input_message">
                <div class="message_input_wrapper">
                    <input class="message_input"
                           @keyup.enter="addMessage()"
                           v-model="message"
                           @click=""
                           placeholder="Type your message here..." />
                </div>

                <div  class="send_message" @click="addMessage()">
                    <div class="icon"></div>
                    <div class="text">
                        Send
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        data() {
            {
                return {
                    message: '',
                    type: '',
                    text: '',
                    error: false,
                    dismissSecs: 4,
                    dismissCountDown: 0,
                    showDismissibleAlert: false
                }
            }
        },
        methods: {
            countDownChanged (dismissCountDown) {
                this.dismissCountDown = dismissCountDown;
                this.error = false;
            },
            typingUsers() {
                let room_id = this.$route.params.room_id;
                this.$http.get('/typingUsers/'+room_id).then(response => {

                    if (response.status == 200) {
                        this.$emit('typing', response.data);
                    } else {
                        // ...
                    }

                }, response => {
                    // ...
                });
            },
            addMessage() {
                let room_id = this.$route.params.room_id;
                this.$http.post('/AddMessage', {message: this.message, room_id: room_id}).then(response => {

                    if (response.body != 'error') {
                        this.message = '';
                        this.$emit('updateMessages', response.data[0]);
                    } else {
                        this.error = true;
                        this.type = 'warning';
                        this.text = 'your message can not be sent!';
                        this.dismissCountDown = this.dismissSecs;
                    }

                }, response => {
                    this.error = true;
                    this.type = 'danger';
                    this.text = 'your message can not be sent!';
                    this.dismissCountDown = this.dismissSecs;
                });
            }
        }
    }
</script>