<template>
    <div id="chat_box">

        <div class="row">

            <div class="col-lg-8" >
                <div class="chat_window">
                    <div class="top_menu">
                        <div class="buttons">
                            <div class="button close"></div>
                            <div class="button minimize"></div>
                            <div class="button maximize"></div>
                        </div>
                        <div class="title">{{ room_name }} online Users {{ onlineUserCount }}</div>
                    </div>

                    <all_messages :all_messages="messages"
                                  :usersTyping="typing"
                                  :latest="latest"
                    ></all_messages>

                    <add_messages v-on:updateMessages="pushMessage($event)"
                                  v-on:typing="userTyping($event)"
                    ></add_messages>

                </div>
            </div>

            <div class="col-lg-4" >

                <activity :actions="actions"></activity>
                <online :onlineUsers="onlineUsers"></online>

            </div>

        </div>

    </div>
</template>

<script>

    import addMessages from './add_messages.vue';
    import allMessages from './all_messages.vue';
    import activity from './activity.vue';
    import online from './online.vue';


    export default {
        components: {
            add_messages: addMessages,
            all_messages: allMessages,
            activity: activity,
            online: online
        },
        data() {
            return {
                messages: [],
                latest: [],
                typing: [],
                channel: '',
                room_name: this.$route.params.room_name,
                room_id: this.$route.params.room_id,
                onlineUsers: [],
                onlineUserCount: '',
                actions:[]
            }
        },
        created() {
            window.onbeforeunload = this.leaving();
            this.getLatest();
            this.BindEvents(this.room_id+'room', 'pushMessage', this.messages);
            this.BindEvents(this.room_id+'typing', 'userTyping', this.typing);
        },
        mounted() {
            this.updateCount();
            this.GetMeOnline();
        },
        methods: {
          leaving() {
              this.$http.get('/leaving/'+this.room_id).then(response => {

                  //...

              }, response => {
                  //...
              });
          },
          pushMessage() {
             // console.log(this.messages);
          },
          userTyping() {
             // console.log(this.typing);
          },
          BindEvents(name, action, array) {
              this.channel = this.$pusher.subscribe(name);
              this.channel.bind(action, (data) => {
                  array.push(data);
              });
          },
          GetMeOnline() {
              this.$http.get('/getMeOnline/'+this.room_id).then(response => {

                  //...

              }, response =>{
                  //...
              });
          },
          updateCount() {
              this.channel = this.$pusher.subscribe(this.room_id+'onlineUser');
              this.channel.bind('onlineUser', (data) => {
                  this.onlineUserCount = data.count;
                  this.onlineUsers = data.conected;
                  this.actions.push(data.actions);
              });

              this.channel = this.$pusher.subscribe(this.room_id+'leaveUser');
              this.channel.bind('leaveUser', (data) => {
                  this.onlineUserCount = data.count;
                  this.onlineUsers = data.conected;
                  this.actions.push(data.actions);
              });
          },
        getLatest() {
            this.$http.get('/GetLatest/'+this.room_id).then(response => {

                if (response.status == 200) {
                    this.latest = response.data;
                } else {
                    // ...
                }

            }, response => {
                // ...
            });
        }
        },
    }

</script>
