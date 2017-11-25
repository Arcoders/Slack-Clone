<template>
    <div id="all_rooms">

        <ul class="list-group">
            <li class="list-group-item list-group-item-info"><b>All Rooms</b> <span class="badge">{{ rooms.length }}</span></li>
        </ul>

        <hr>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Room Name</th>
                    <th>Add Date</th>
                    <th>User</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="room in rooms">
                    <td>{{ room.name }}</td>
                    <td>{{ room.created_at | moment("from", "now") }}</td>
                    <td>{{ room.user.name }}</td>
                </tr>
                <tr v-if="isLoading">
                    <td colspan="3">
                        <vue-simple-spinner message="Loading..."></vue-simple-spinner>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
</template>

<script>
    export default {
        mounted() {
            this.getAllRooms();
        },
        data() {
            return {
                isLoading: true,
                rooms: []
            };
        },
        methods: {
            getAllRooms: function () {

                this.$http.get('/getAllRooms').then(response => {

                    this.rooms = response.data;
                    this.isLoading = false;

                }, response => {

                });

            }
        }
    }
</script>
