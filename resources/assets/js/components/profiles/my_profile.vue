<template>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-2">
                <img v-if="image" :src="image" class="img-responsive">
                <avatar v-else  :username="currentUserName"
                         color="#fff"
                         class="avatar"
                        :size="100">
                </avatar>
            </div>
            <div class="col-md-8">
                <input type="file" v-on:change="onFileChange" class="form-control">
            </div>
            <div class="col-md-2">
                <button class="btn btn-success btn-block" @click="upload">Upload</button>
            </div>
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
                this.$http.post('/AddNewRoom', {image: this.image}).then(response => {

                    console.log(this.image);

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