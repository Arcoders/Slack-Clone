<template>
    <div id="all_rooms">

        <ul class="list-group">
            <li class="list-group-item list-group-item-info"><b>My Rooms</b> <span class="badge">{{ rooms.length }}</span></li>
        </ul>

        <hr>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Room Name</th>
                <th>Add Date</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(room, index) in rooms">
                <td>
                    <router-link :to="{ name: 'chatbox', params: { room_id: room.id, room_name: checkUser(room.user_id, room.user.name, room.friend.name) }}">
                        {{ checkUser(room.user_id, room.user.name, room.friend.name) }}
                    </router-link>
                </td>
                <td>{{ room.created_at | moment("from", "now") }}</td>
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
            this.getCurrentUser();
            this.getMyRooms();
        },
        data() {
            return {
                isLoading: true,
                notFound: false,
                error: false,
                rooms: [],
                currentUserId: ''
            };
        },
        methods: {
            checkUser(userId, userName, friendName) {
                if (userId == this.currentUserId) {
                    return friendName;
                } else {
                    return userName;
                }
            },
            getMyRooms: function () {

                this.$http.get('/getPrivate').then(response => {

                    this.isLoading = false;

                    if (response.data.length > 0) {
                        this.rooms = response.data;
                    } else {
                        this.notFound = true;
                    }

                }, response => {
                    this.isLoading = false;
                    this.error = true;
                });

            },
            getCurrentUser() {
                this.$http.get('/getCurrentUser').then(response => {

                    if (response.status == 200) {
                        this.currentUserId = response.body.id;
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
