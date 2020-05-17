<template>
    <div>

        <nav class="navbar navbar-expand-xl navbar-dark bg-dark py-2">
            <a class="navbar-brand font-weight-bold text-uppercase pl-5" href="#">Drivify</a>
            <div class="dropdown pmd-dropdown pmd-user-info ml-auto">
                <a href="#" class="btn-user media align-items-center" data-toggle="dropdown" data-sidebar="true"
                   aria-expanded="false">
                    <div class="media-body mr-3 text-white font-weight-bold ">Bienvenido, {{profile.username}}</div>
                    <div class="img mr-5 d-none rounded-circle d-lg-block" alt="avatar"></div>
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
                .then(response => {this.profile = response.data;  });


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
    .img{
        width: 40px;
        height: 40px;
        background-image: url('https://pro.propeller.in/assets/images/avatar-icon-40x40.png');


    }
</style>
