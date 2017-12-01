<template>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-2">

                <avatar :username="currentUserName"
                         color="#fff"
                         class="avatar"
                        :src="image"
                        :size="100">
                </avatar>
            </div>
            <form method="POST" v-on:submit.prevent="upload()" enctype="multipart/form-data">
                <div class="col-md-8">
                    <input type="file" name="image" v-on:change="onFileChange" class="form-control">
                </div>
                <div class="col-md-2">
                    <input class="btn btn-success btn-block" type="submit" value="Upload">
                </div>
            </form>
        </div>
    </div>
</template>
<style scoped>
    img{
        height: 100px;
        width: 100px;
        border-radius: 50%;
    }
</style>
<script>
    export default{
        data(){
            return {
                image: '',
                currentUserName: ''
            }
        },
        created() {
            this.getCurrentUser();
        },
        methods: {
            onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            upload() {
                this.$http.post('/UploadAvatar', {image: this.image}).then(response => {

                    if (response.body == 1) {
                        // ...
                    } else {
                        // ...
                    }

                }, response => {
                    // ...
                });
            },
            getCurrentUser() {
                this.$http.get('/getCurrentUser').then(response => {

                    if (response.status == 200) {
                        this.currentUserName = response.body.name;
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