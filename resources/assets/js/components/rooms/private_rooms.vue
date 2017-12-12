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
                    <router-link :to="{ name: 'chatbox', params: { room_id: room.id, room_name: 'private' }}">
                        private
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
            this.getMyRooms();
        },
        data() {
            return {
                isLoading: true,
                notFound: false,
                error: false,
                rooms: []
            };
        },
        methods: {
            getMyRooms: function () {

                this.$http.get('/getPrivate').then(response => {

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

            }
        }
    }
</script>
