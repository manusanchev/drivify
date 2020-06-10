<template>
    <div>
        <profile-data></profile-data>
        <notifications group="foo"/>
        <div class="container bg-light d-flex justify-content-between shad align-items-center flex-column flex-md-row p-5 mt-5 mb-5 r-menu">
            <router-link to="/perfil" class="text-decoration-none">
                <div class="menu bg-white shadow r-menu mb-2">
                    <div class="img-menu img-menu-1 r-menu"></div>
                    <p class="font-weight-bold text-center h5 p-2">Cuenta</p>
                </div>
            </router-link>
            <router-link to="/viaje" class="text-decoration-none">
                <div class="menu bg-white shadow  r-menu mb-2">
                    <div class="img-menu img-menu-2  r-menu"></div>
                    <p class="font-weight-bold text-center h5 p-2">Ir de viaje</p>
                </div>
            </router-link>
            <router-link to="/tusViajes" class="text-decoration-none">
                <div class="menu bg-white shadow r-menu mb-2">
                    <div class="img-menu img-menu-3 r-menu "></div>
                    <p class="font-weight-bold text-center h5 p-2">Mis viajes</p>
                </div>
            </router-link>
            <router-link to="/logros" class="text-decoration-none">
                <div class="menu bg-white shadow  r-menu mb-2">
                    <div class="img-menu img-menu-4 r-menu"></div>
                    <p class="font-weight-bold text-center h5 p-2">Logros</p>
                </div>
            </router-link>
        </div>

    </div>


</template>


<script>
    export default {
        props:["listo"],
        data(){
            return {

            }
        },
        mounted() {
            console.log(this.listo);
            if(this.listo === 'ocupante-listo'){
                this.$notify({
                    group: 'foo',
                    type: 'success',
                    title: 'Guardado con exito!',
                    duration: 10000,
                });
            }

        }
    }
</script>

<style scoped>


    .img-menu{
        width: 200px;
        height: 200px;
        background-repeat: no-repeat;
        background-size: contain;
        background-position: center;
    }
    .img-menu-1{

        background-image: url('/images/cuenta.png');

    }
    .img-menu-2{

        background-image: url('/images/irDeViaje.png');

    }
    .img-menu-3{

        background-image: url('/images/misViajes.png');

    }
    .img-menu-4{

        background-image: url('/images/tienda.png');

    }

    .r-menu{
        border-radius: 15px;
    }



</style>
