<template>
    <div id="add_room" class="row">

            <h2>Add New Room</h2>
            <hr>

        <vue-simple-spinner v-if="isLoading" message="Loading..."></vue-simple-spinner>

            <b-alert :show="dismissCountDown"
                     dismissible
                     v-bind:variant="type"
                     @dismissed="dismissCountDown=0"
                     @dismiss-count-down="countDownChanged">

                <p>{{text}} {{dismissCountDown}} seconds...</p>
                <b-progress v-bind:variant="type"
                            :max="dismissSecs"
                            :value="dismissCountDown"
                            height="4px">
                </b-progress>
            </b-alert>


            <div v-if="!isLoading" class="input-group">

                <input type="text"
                       v-model="room_name"
                       id="name"
                       class="form-control"
                       placeholder="Search for..."
                       aria-label="Search for...">

                <span class="input-group-btn">
                    <button class="btn btn-primary"
                            @click="AddRoom()"
                            value="Add Room"
                            v-bind:disabled="btnSubmit"
                            type="button">
                        Add Room
                    </button>
                  </span>
            </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                room_name: '',
                type: '',
                text: '',
                isLoading: false,
                dismissSecs: 4,
                dismissCountDown: 0,
                showDismissibleAlert: false
            }
        },
        computed: {
            btnSubmit() {
                if ( this.room_name.length < 5) {
                    return true;
                } else {
                    return false;
                }
            }
        },
        methods: {
            countDownChanged (dismissCountDown) {
                this.dismissCountDown = dismissCountDown;
            },
            AddRoom () {
                this.SendRequest();
            },
            SendRequest() {

                this.isLoading = true;
                this.$http.post('/AddNewRoom', {name: this.room_name}).then(response => {

                    this.isLoading = false;
                    this.type = 'success';
                    this.text = 'Your room has been added!';
                    this.dismissCountDown = this.dismissSecs;

                }, response => {
                    this.isLoading = false;
                    this.type = 'warning';
                    this.text = 'Your room can not added!';
                    this.dismissCountDown = this.dismissSecs;
                });
            }
        }
    }
</script>
