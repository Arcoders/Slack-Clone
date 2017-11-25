<template>
    <div id="add_room" class="row">

            <h2>Add New Room</h2>
            <hr>

            <vue-simple-spinner v-if="isLoading" message="Loading..."></vue-simple-spinner>

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
                isLoading: false
            }
        },
        methods: {
            AddRoom() {
                this.isLoading = true;
            }
        }
    }
</script>
