<template>
    <div id="all_rooms">

        <h2>All Rooms</h2>
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
                    <td>{{ room.created_at }}</td>
                    <td>{{ room.user.name }}</td>
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
                rooms: []
            };
        },
        methods: {
            getAllRooms: function () {

                this.$http.get('/getAllRooms').then(response => {

                    this.rooms = response.data;

                }, response => {

                });

            }
        }
    }
</script>
