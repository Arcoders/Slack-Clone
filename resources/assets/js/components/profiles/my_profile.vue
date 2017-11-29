<template>
    <div id="add_room" class="row">

        <h2>Upload Your Avatar</h2>
        <hr>

        <vue-simple-spinner v-if="false" message="Loading..."></vue-simple-spinner>

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


        <div class="input-group">

            <input type="file"
                   name="file"
                   id="file"
                   class="form-control"
                   placeholder="Select an image...">

            <span class="input-group-btn">
                    <button class="btn btn-primary"
                            value="Add Room"
                            v-bind:disabled="true"
                            type="button">
                        Upload
                    </button>
                  </span>
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                type: '',
                text: '',
                dismissSecs: 4,
                dismissCountDown: 0,
                showDismissibleAlert: false
            }
        },
        computed: {

        },
        methods: {
            countDownChanged (dismissCountDown) {
                this.dismissCountDown = dismissCountDown;
            },
            SendRequest() {

                this.$http.post('/AddNewRoom').then(response => {


                    if (response.body == 1) {
                        // ...
                    } else {
                        // ...
                    }

                }, response => {
                    // ...
                });
            }
        }
    }
</script>
