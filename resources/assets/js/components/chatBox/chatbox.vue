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

            <all_messages :messages="messages"></all_messages>
            <add_messages></add_messages>

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
                messages: []
            }
        },
        events: {
            new_message(data) {
                this.messages.push(data);
            }
        }
    }

</script>
