<template>
    <div id="chat_online">
        <h3>Online Users</h3>
        <hr>
        <div class="maximo">
            <a v-for="online in onlineUsers"
               class="btn btn-success btn-xs">
                {{ online.user.name }}
            </a>
        </div>
    </div>
</template>

<script>

    export default {
        props: ['onlineUsers'],
        data() {
            return {
                msg: 'Hola ON'
            }
        }
    }

</script>