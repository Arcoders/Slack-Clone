<template>
    <div id="all_messages">
        <ul class="messages">
            <li class="message left appeared" v-for="message in messages">
                <div class="avatar"></div>
                <div class="text_wrapper">
                    <div class="text">
                        {{ message.body }}
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: ['messages'],
        data() {
            {
                return {

                }
            }
        }
    }
</script>