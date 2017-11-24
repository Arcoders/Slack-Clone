<template>
    <div id="all_rooms">

        <h2>All Rooms</h2>
        <hr>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Room Name</th>
                    <th>Add Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Room Name</td>
                    <td>24/11/2017</td>
                </tr>
            </tbody>
        </table>

    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('All rooms.')
        }
    }
</script>
