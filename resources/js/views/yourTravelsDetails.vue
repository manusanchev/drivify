<template>
    <div>
        <div class="container w-75 shadow p-4 mt-4">
            <div id="map"></div>
        </div>
        <div class="container w-75 shadow p-4 my-4">
            <div class="container d-flex justify-content-around align-items-center">
                <router-link to="/tusViajes">
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
            </div>
            <div class="container shadow bg-light p-4 my-4">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Salida</th>
                        <th scope="col">Destino</th>
                        <th scope="col">Ocupantes</th>
                        <th scope="col">Kms</th>
                        <th scope="col">Fecha</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{viaje.departure}}</td>
                        <td>{{viaje.destination}}</td>
                        <td>{{viaje.passengers}}</td>
                        <td>{{viaje.distance}} KM</td>
                        <td>{{viaje.travel_date}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>


<script>
    import mapboxgl from "mapbox-gl";

    export default {
        data(){
            return {
                url: window.location.origin,
                viaje:{},
                accessToken: 'pk.eyJ1IjoibWFudWVsc2FuY2hldiIsImEiOiJja2FiM2h2a2Ywejl1MnpsNWdjcG9uZGRhIn0.vvyM4shacZk92t-g3m7kFA',
            }
        },
        mounted(){
            let id = window.location.search.split("=")[1];
            let formData = new FormData();
            formData.append("id",id);
            axios.post(this.url+"/auth-api/tusViajes/detalles", formData)
            .then(response => {
                this.viaje = response.data;
                this.initMap();
            });
        },
        methods:{
            initMap() {
                mapboxgl.accessToken = this.accessToken;
                var map = new mapboxgl.Map({
                    container: 'map',
                    style: 'mapbox://styles/mapbox/streets-v11',
                    center: [-3.7025600, 40.4165000],
                    zoom: 5
                });

                this.directions = new MapboxDirections({
                    accessToken: mapboxgl.accessToken,
                    profile: 'mapbox/driving',
                    alternatives: false,
                    placeholderOrigin: "Elige el lugar de salida",
                    placeholderDestination: "Elige el lugar de destino"

                })
                map.addControl(
                    this.directions,
                    'top-left'
                );
            

                this.directions.setOrigin(this.viaje.departure);
                this.directions.setDestination(this.viaje.destination);

            },
        }
    }
</script>


<style scoped>

</style>
