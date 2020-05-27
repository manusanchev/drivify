<template>
    <div>
        <div class="container w-75 shadow p-4 mt-4">
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
            <form>
                <label>Buscar Viajes por fecha</label><input type="date" class="form-control">
            </form>
            <hr>
            <form>
                <label>Salida</label> <select name="" id=""><option value="">Sevilla</option></select> <b>-o-</b>
                <label>Destino</label> <select name="" id=""><option value="">Lebrija</option></select>
            </form>
        </div>
        <div class="container w-75 shadow p-4 mt-4">
            <div class="container d-flex justify-content-around align-items-center">
                <a href=""><div class="p-3 bg-light">Prev</div></a>
                <div class="p-3 bg-light">Tus viajes</div>
                <a href=""><div class="p-3 bg-light">Next</div></a>
            </div>
            <div class="container shadow bg-light p-4 my-4">
                <div class="container-fluid my-4 d-flex justify-content-around align-items-center flex-column flex-sm-row flex-md-row flex-lg-row flex-xl-row">
                    <div class="icon-map"></div>
                    <div class="d-flex justify-content-around align-content-center flex-column">
                        <h3>17-02-2020</h3>
                        <h3>Sevilla-Lebrija</h3>
                    </div>
                    <button class="btn btn-dark px-5 py-2">Detalle</button>
                </div>
                <hr>
                <div class="container-fluid my-4 d-flex justify-content-around align-items-center flex-column flex-sm-row flex-md-row flex-lg-row flex-xl-row">
                    <div class="icon-map"></div>
                    <div class="d-flex justify-content-around align-content-center flex-column">
                        <h3>17-02-2020</h3>
                        <h3>Sevilla-Lebrija</h3>
                    </div>
                    <button class="btn btn-dark px-5 py-2">Detalle</button>
                </div>
                <hr>
                <div class="container-fluid my-4 d-flex justify-content-around align-items-center flex-column flex-sm-row flex-md-row flex-lg-row flex-xl-row">
                    <div class="icon-map"></div>
                    <div class="d-flex justify-content-around align-content-center flex-column">
                        <h3>17-02-2020</h3>
                        <h3>Sevilla-Lebrija</h3>
                    </div>
                    <button class="btn btn-dark px-5 py-2">Detalle</button>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    export default {

    }
</script>


<style scoped>
    .icon-map{
        background-image: url('https://cdn.pixabay.com/photo/2016/03/22/04/23/map-1272165_1280.png');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        width: 100px;
        height: 100px;
    }

</style>
