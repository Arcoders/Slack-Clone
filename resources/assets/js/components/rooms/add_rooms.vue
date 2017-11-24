<template>
    <div id="add_room" class="row">

        <h2>Add New Room</h2>
        <hr>

        <div class="col-md-8">
            <input type="text" id="name" class="form-control" placeholder="Room name">
        </div>

        <div class="col-md-4">
            <input type="submit" value="Add Room" class="btn btn-default">
        </div>

    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Add rooms.')
        }
    }
</script>
