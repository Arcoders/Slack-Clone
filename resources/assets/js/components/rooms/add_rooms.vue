<template>
    <div id="add_room" class="row">

            <h2>Add New Room</h2>
            <hr>

            <b-alert :show="dismissCountDown"
                     dismissible
                     variant="warning"
                     @dismissed="dismissCountDown=0"
                     @dismiss-count-down="countDownChanged">
                <vue-simple-spinner v-if="isLoading" message="Loading..."></vue-simple-spinner>
                <p>This alert will dismiss after {{dismissCountDown}} seconds...</p>
                <b-progress variant="warning"
                            :max="dismissSecs"
                            :value="dismissCountDown"
                            height="4px">
                </b-progress>
            </b-alert>

            <div v-if="!isLoading" class="mi_formulario">

                <div class="col-md-8">
                    <input type="text" v-model="room_name" id="name" class="form-control" placeholder="Room name">
                </div>

                <div class="col-md-4">
                    <input type="submit" @click="AddRoom()" value="Add Room" class="btn btn-default">
                </div>

            </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                room_name: '',
                isLoading: false,
                dismissSecs: 3,
                dismissCountDown: 0,
                showDismissibleAlert: false
            }
        },
        methods: {
            countDownChanged (dismissCountDown) {
                this.dismissCountDown = dismissCountDown;
            },
            AddRoom () {
                this.isLoading = true;
                this.dismissCountDown = this.dismissSecs;
            }
        }
    }
</script>
