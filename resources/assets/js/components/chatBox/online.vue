<template>
    <div id="chat_online">
        <h3>Online Users</h3>
        {{ user }}
        <hr>
        <div class="maximo">
            <div v-for="online in onlineUsers">
                <div class="alert alert-info">
                    <avatar :username="online.user.name"
                            color="#fff"
                            class="avatar"
                            :src="online.user.avatar"
                            :size="50">
                    </avatar>
                    <span>{{ online.user.name }}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        props: ['onlineUsers', 'user'],
        data() {
            return {
                msg: 'Hola ON'
            }
        }
    }

</script>