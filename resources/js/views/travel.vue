<template>
    <div class="con">
        
       
        <div class="main container bg-light shadow mt-5 mb-5 r-menu">
            <router-link to="/home">
                <svg class="bi bi-arrow-left" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M5.854 4.646a.5.5 0 010 .708L3.207 8l2.647 2.646a.5.5 0 01-.708.708l-3-3a.5.5 0 010-.708l3-3a.5.5 0 01.708 0z"
                          clip-rule="evenodd"/>
                    <path fill-rule="evenodd" d="M2.5 8a.5.5 0 01.5-.5h10.5a.5.5 0 010 1H3a.5.5 0 01-.5-.5z"
                          clip-rule="evenodd"/>
                </svg>
                Volver
            </router-link>
            <div class="container d-flex align-items-center flex-column pb-5 mb-5">

                <h1 class="pb-5">Elige una opción</h1>
                <router-link :to="{ path: 'conductor'}" append class="btn btn-lg w-25 p-3 shadow btn-dark w-50">Conductor</router-link>
                <p class="font-weight-bold h3 ">-</p>
                <router-link :to="{ path: 'ocupante'}" append class="btn btn-lg w-25 p-3 shadow btn-dark w-50">Ocupante</router-link>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

    }
</script>


<style scoped>
 .con {
  min-height: 80vh;
}
</style>
