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
                    <input type="file" name="fileInput" v-on:change="onFileChange($event)" ref="fileInput" class="form-control">
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
        props: ['user'],
        data(){
            return {
                image: null,
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

                let formData = new FormData();
                formData.append('fileInput', this.$refs.fileInput.files[0]);

                this.$http.post('/UploadAvatar', formData).then(response => {

                    if (response.status == 200) {
                        this.image = response.data;
                    } else {
                        this.image = null
                    }

                }, response => {
                    this.image = null
                });
            },
            getCurrentUser() {
                this.$http.get('/getCurrentUser').then(response => {

                    if (response.status == 200) {
                        this.currentUserName = response.body.name;
                        this.image = response.body.avatar;
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
