<template>
    <div class="con">
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
                <label>Buscar Viajes por fecha</label><input type="date" v-model="fecha" class="form-control"
                                                             @change="search(null)">
            </form>
            <hr>
            <form>
                <label>Salida</label>
                <select v-model="salida" @change="getOptionDestination">
                    <option v-for="salid in optionDeparture" :value="salid" >{{salid}}</option>
                </select>
                <br>
                <label>Destino</label>
                <select v-model="destino" @change="search(null)">
                <option v-for="desti in optionDestination" :value="desti">{{desti}}</option>
            </select>
            </form>
        </div>
        <div class="container w-75 shadow p-4 mt-4">
            <div class="container d-flex justify-content-around align-items-center">
                <div class="p-3 bg-light page-link" @click="search(viajes.prev_page_url)">Prev</div>
                <div class="p-3 bg-light">Pagina {{viajes.current_page}} / {{viajes.last_page}}</div>
                <div class="p-3 bg-light page-link" @click="search(viajes.next_page_url)">Next</div>
            </div>
            <div class="container shadow bg-light p-4 my-4">
                <div v-for="viaje in viajes.data" :key="viaje.id"
                     class="container-fluid my-4 d-flex justify-content-around align-items-center flex-column flex-sm-row flex-md-row flex-lg-row flex-xl-row">
                    <div class="icon-map"></div>
                    <div class="d-flex justify-content-around align-content-center flex-column">
                        <h3>{{viaje.travel_date}}</h3>
                        <h6>Salida: {{viaje.departure}}<br>Destino: {{viaje.destination}}</h6>
                    </div>
                    <router-link class="btn btn-dark px-5 py-2" :to="{ path: '/tusViajes/detalles', query: { travel: viaje.id }}">Detalle</router-link>

                </div>

            </div>
        </div>
    </div>
</template>


<script>
    export default {
        data() {
            return {
                fecha: '',
                salida: '',
                destino: '',
                viajes: [],
                url: window.location.origin,
                optionDestination: [],
                optionDeparture: [],
            }
        },
        mounted() {
            this.getOptionDeparture();
        },
        methods: {
            async search(page) {

                page = page || this.url + "/auth-api/tusViajes/getViajes";
                let formData = new FormData();

                formData.append('fecha', this.fecha);
                formData.append('salida', this.salida);
                formData.append('destino', this.destino);


                const response = await axios.post(page, formData);
                this.viajes = response.data;
            },
            async getOptionDeparture() {
                let options = await axios.get(this.url + "/auth-api/tusViajes/options");

                this.optionDeparture = options.data.departures;

            },
            async getOptionDestination(){
                let formData = new FormData();
                formData.append('salida',this.salida);
                let options = await axios.post(this.url+"/auth-api/tusViajes/destination", formData);
               this.optionDestination = options.data.destinations;
            }
        }
    }
</script>


<style scoped>
    .icon-map {
        background-image: url('https://cdn.pixabay.com/photo/2016/03/22/04/23/map-1272165_1280.png');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        width: 100px;
        height: 100px;
    }

    .page-link {
        cursor: pointer;
    }

    .show {
        display: none !important;
    }
 .con {
  min-height: 80vh;
}


</style>
