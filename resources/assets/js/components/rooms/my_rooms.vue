<template>
    <div id="all_rooms">

        <ul class="list-group">
            <li class="list-group-item list-group-item-info"><b>My Rooms</b> <span class="badge">{{ rooms.length }}</span></li>
        </ul>

        <hr>

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

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Room Name</th>
                <th>Add Date</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(room, index) in rooms">
                <td>
                    <router-link :to="{ name: 'chatbox', params: { room_id: room.id }}">
                        {{ room.name }}
                    </router-link>
                </td>
                <td>{{ room.created_at | moment("from", "now") }}</td>
                <td>
                    <button @click="deleteRoom(room.id, index)" type="button" class="btn btn-danger btn-xs">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </td>
            </tr>
            <tr v-if="isLoading">
                <td colspan="3">
                    <vue-simple-spinner message="Loading..."></vue-simple-spinner>
                </td>
            </tr>
            <tr v-if="notFound">
                <td colspan="3">
                    No records found please
                    <router-link to="/addrooms">
                        Add Room
                    </router-link>
                </td>
            </tr>
            <tr v-if="error">
                <td colspan="3">
                    <div class="alert alert-danger">
                        <strong>Error!</strong> rejected request.
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

    </div>
</template>

<script>
    export default {
        mounted() {
            this.getMyRooms();
        },
        data() {
            return {
                isLoading: true,
                notFound: false,
                error: false,
                rooms: [],
                type: '',
                text: '',
                dismissSecs: 4,
                dismissCountDown: 0,
                showDismissibleAlert: false
            };
        },
        methods: {
            countDownChanged (dismissCountDown) {
                this.dismissCountDown = dismissCountDown;
            },
            getMyRooms: function () {

                this.$http.get('/getMyRooms').then(response => {

                    this.isLoading = false;
                    this.rooms = response.data;

                    if (this.rooms.length > 0) {
                        this.rooms = response.data;
                    } else {
                        this.notFound = true;
                    }

                }, response => {
                    this.isLoading = false;
                    this.error = true;
                });

            },
            deleteRoom: function (room_id, index) {

                this.isLoading = true;

                this.$http.delete('/deleteRoom/'+room_id).then(response => {

                    this.isLoading = false;

                    if (response.body == 'done') {
                        this.rooms.splice(index, 1);
                        this.type = 'success';
                        this.text = 'Your room has been deleted!';
                        this.dismissCountDown = this.dismissSecs;
                        this.getMyRooms();
                    } else {
                        this.type = 'warning';
                        this.text = 'Room can not be deleted!';
                        this.dismissCountDown = this.dismissSecs;
                    }

                }, response => {
                    this.isLoading = false;
                    this.type = 'danger';
                    this.text = 'Error in the request, sorry room can not added!';
                    this.dismissCountDown = this.dismissSecs;
                });

            }
        }
    }
</script>
