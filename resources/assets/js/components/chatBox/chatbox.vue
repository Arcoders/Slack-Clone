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

                    <all_messages :all_messages="messages"></all_messages>
                    <add_messages v-on:updateMessages="pushMessage($event)"></add_messages>

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
                channel: '',
                room_name: this.$route.params.room_name,
                room_id: this.$route.params.room_id,
                onlineUsers: [],
                onlineUserCount: '',
                actions:[]
            }
        },
        created() {
            this.BindEvents(this.room_id+'room', 'pushMessage', this.messages);
        },
        mounted() {
            this.updateCount();
            this.GetMeOnline();
        },
        methods: {
          pushMessage(data) {
              // ...
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

              }, response => {
                  //...
              });
          },
          updateCount() {
              this.channel = this.$pusher.subscribe(this.room_id+'online');
              this.channel.bind('onlineUser', (data) => {
                  this.onlineUserCount = data.count;
                  this.onlineUsers = data.conected;
                  this.actions.push(data.actions);
              });

              this.channel = this.$pusher.subscribe(this.room_id+'offline');
              this.channel.bind('leaveUser', (data) => {
                  this.onlineUserCount = data.count;
                  this.onlineUsers = data.conected;
                  this.actions.push(data.actions);
              });
          }
        },
    }

</script>
