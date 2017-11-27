<template>
    <div id="chat_box">
        <div class="chat_window">
            <div class="top_menu">
                <div class="buttons">
                    <div class="button close"></div>
                    <div class="button minimize"></div>
                    <div class="button maximize"></div>
                </div>
                <div class="title">{{ room_name }} online Users {{ WhoisOnline.length }}</div>
            </div>

            <all_messages :all_messages="messages"></all_messages>
            <add_messages v-on:updateMessages="pushMessage($event)"></add_messages>

        </div>
    </div>
</template>

<script>

    import addMessages from './add_messages.vue';
    import allMessages from './all_messages.vue';

    export default {
        components: {
            add_messages: addMessages,
            all_messages: allMessages
        },
        data() {
            return {
                messages: [],
                channel: '',
                room_name: this.$route.params.room_name,
                room_id: this.$route.params.room_id,
                WhoisOnline: []
            }
        },
        mounted: function() {
            this.BindEvents(this.room_id+'room', 'pushMessage');
            this.GetMeOnline();
        },
        methods: {
          pushMessage(data) {
              // ...
          },
          BindEvents(name, action) {
              this.channel = this.$pusher.subscribe(name);
              this.channel.bind(action, (data) => {
                  this.messages.push(data);
              });
          },
          GetMeOnline() {
              this.$http.get('/getMeOnline/'+this.room_id).then(response => {

                  this.WhoisOnline.push(response.data);

              }, response => {
                  //...
              });
          }
        },
    }

</script>
