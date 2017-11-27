<template>
    <div id="chat_box">
        <div class="chat_window">
            <div class="top_menu">
                <div class="buttons">
                    <div class="button close"></div>
                    <div class="button minimize"></div>
                    <div class="button maximize"></div>
                </div>
                <div class="title">..........</div>
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
                channel: ''
            }
        },
        mounted: function() {
            this.channel = this.$pusher.subscribe(this.$route.params.room_id+'room');
            this.channel.bind('pushMessage', (data) => {
                this.messages.push(data);

            });
        },
        methods: {
          pushMessage(data) {
              // ...
            },

        },
    }

</script>
