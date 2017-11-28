<template>
    <div id="chat_activity">
        <div class="well maximo">
            <a v-for="a in ac"
                    class="btn btn-success btn-xs">
                    {{ a.user.name }}
            </a>
        </div>
    </div>
</template>

<script>

    export default {
        props: ['ac'],
        data() {
            return {
                msg: 'Hola AC'
            }
        }
    }

</script>