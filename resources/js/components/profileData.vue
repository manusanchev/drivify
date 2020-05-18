<template>
    <div>
        <header>
            <div class="profile-header container-fluid"></div>
            <div class="container-img container d-flex justify-content-around">

                <div v-if="profile.image!=null" class="shadow img-xl rounded-circle" alt="avatar" :style="{backgroundImage: 'url(' + profile.image+')'}"></div>
                <div v-else class="shadow img-xl default rounded-circle" alt="avatar"></div>
            </div>
        </header>
        <div class="container-fluid d-flex justify-content-between mt-2">
            <div
                class="bg-dark text-white p-2 mt-sm-3 w-25 shadow r-menu font-weight-bold h6 d-flex flex-column align-items-center ">
                <h6>Puntos</h6>
                <h4><span class="badge badge-secondary">{{profile.points}}</span></h4>
            </div>
            <div
                class="bg-dark text-white p-2 mt-sm-3 w-25 shadow r-menu font-weight-bold h6 d-flex flex-column align-items-center">
                <h6>Kilometros</h6>
                <h4><span class="badge badge-secondary">{{profile.kms}}</span></h4>
            </div>
        </div>
        <hr>
    </div>
</template>


<script>
    export default {
        data(){
            return{
                url: window.location.origin,
                profile:{}

            }
        },
        methods: {
            getData(){
                axios.get(this.url+"/auth-api/user")
                    .then(response => {
                        this.profile = response.data;
                        this.profile.image = "/images/"+this.profile.image;

                    });


            }
        },
        mounted() {
            this.getData();
        }
    }
</script>

<style scoped>
    .profile-header{
        height: 35vh;
        background-image: url('/css/auth/login.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        border-bottom: 1px solid rgb(65, 60, 60);
        filter: blur(1px);

    }
    .default{
        background-image: url('/css/auth/login.jpg');
    }
    .img-xl{

        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        width: 200px;
        height: 200px;
        margin: -10%;
        border:4px solid rgb(167, 155, 155);
        z-index: 9999;
    }
    .r-menu{
        border-radius: 15px;
    }
    @media only screen and (max-width: 600px) {
        .img-xl{
            width: 120px;
            height: 120px;
            margin: -15%;

        }

    }

    @media only screen and (max-width: 1000px) {
        .img-xl{
            width: 150px;
            height: 150px;
            margin: -15%;

        }

    }
</style>
