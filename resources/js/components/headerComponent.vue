<template>
    <div>

        <nav class="navbar navbar-expand-xl navbar-dark bg-dark py-2">
            <router-link class="navbar-brand font-weight-bold text-uppercase pl-5" to="/home">Drivify</router-link>
            <div class="dropdown pmd-dropdown pmd-user-info ml-auto">
                <a href="#" class="btn-user media align-items-center" data-toggle="dropdown" data-sidebar="true"
                   aria-expanded="false">
                    <div class="media-body mr-3 text-white font-weight-bold ">Bienvenido, {{profile.username}}</div>

                <div v-if="profile.image!=null" class="img default mr-5 d-none rounded-circle d-lg-block" :style="{backgroundImage: 'url(' + profile.image+')'}" alt="avatar"></div>
                 <div v-else class="img default mr-5 d-none rounded-circle d-lg-block" alt="avatar"></div>

                </a>
                <form action="/logout" method="post">
                    <input type="hidden" name="_token" v-bind:value="csrf">
                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                        <button class="dropdown-item p-2" href="#">Cerrar Sesion</button>
                    </ul>
                </form>

            </div>
        </nav>
       <router-view></router-view>

    </div>


</template>

<script>

    export default {
        data(){
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                url: window.location.origin,
                profile:{}
            }
        },
        methods: {
            getData(){
                axios.get(this.url+"/auth-api/user")
                .then(response => {
                    this.profile = response.data;
                    if(this.profile.image!=null)
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

    *{
        margin: 0;
        padding: 0;

    }
    .default{
        background-image: url('/css/auth/login.jpg');
    }
    .img{
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        width: 40px;
        height: 40px;



    }
</style>
