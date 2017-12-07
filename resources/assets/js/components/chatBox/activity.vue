<template>
    <div id="chat_activity">
        <div class="maximo" v-chat-scroll>
            <div class="alert alert-success" v-for="action in actions">
                <strong>{{ action }}</strong>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        props: ['actions'],
        data() {
            return {
                msg: 'Hola AC'
            }
        }
    }

</script>