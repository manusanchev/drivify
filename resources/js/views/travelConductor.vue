<template>
    <div>

        <div class="main container bg-light shadow mt-5 mb-5  r-menu">
            <notifications group="foo"/>
            <router-link to="/viaje">
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
            <h4 class="pb-5 text-center">Introduce el numero de total de ocupantes</h4>
            <input type="number" min="2" class="form-control w-100 p-4 m-3" v-model="ocupantes" placeholder="Ocupantes" required >
            <h1 class="pb-5 text-center">Selecciona una salida y un destino</h1>
            <div id="map"></div>
            <input type="submit" @click="guardarDatos" class="btn btn-lg w-100 p-3 mt-4 shadow btn-dark w-50"
                   value="Entrar en la sala">


        </div>


    </div>
</template>


<script>
    import mapboxgl from 'mapbox-gl';
    import MapboxDirections from '@mapbox/mapbox-gl-directions/dist/mapbox-gl-directions'

    export default {
        data() {
            return {
                accessToken: 'pk.eyJ1IjoibWFudWVsc2FuY2hldiIsImEiOiJja2FiM2h2a2Ywejl1MnpsNWdjcG9uZGRhIn0.vvyM4shacZk92t-g3m7kFA',
                directions: null,
                salida: '',
                destino: '',
                cooSalida: [],
                cooDestino: [],
                distancia: 0,
                duracion: 0,
                ocupantes: 2,
                url: window.location.origin

            }
        },
        mounted() {
            this.initMap();
        },
        methods: {
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
            },
           async guardarDatos() {

                if (Object.keys(this.directions.getOrigin()).length !== 0 && Object.keys(this.directions.getDestination()).length !== 0) {
                    this.cooSalida = this.directions.getOrigin().geometry.coordinates;
                    this.cooDestino = this.directions.getDestination().geometry.coordinates;

                    let urlSalida = `https://api.mapbox.com/geocoding/v5/mapbox.places/${this.cooSalida[0]}%2C${this.cooSalida[1]}.json?access_token=${this.accessToken}`
                    let urlDestino = `https://api.mapbox.com/geocoding/v5/mapbox.places/${this.cooDestino[0]}%2C${this.cooDestino[1]}.json?access_token=${this.accessToken}`

                    //nombre salida
                    let response  = await axios.get(urlSalida);
                    this.salida = response.data.features[2].place_name;

                    //nombre destino
                   let response2  = await axios.get(urlDestino)
                    this.destino = response2.data.features[2].place_name;


                    let urlDatosTrayecto = `https://api.mapbox.com/directions/v5/mapbox/driving/${this.cooSalida[0]}%2C${this.cooSalida[1]}%3B${this.cooDestino[0]}%2C${this.cooDestino[1]}?access_token=${this.accessToken}`;
                   let response3  = await axios.get(urlDatosTrayecto)
                    this.distancia = response3.data.routes[0].distance;
                    this.duracion = response3.data.routes[0].duration;


                    this.distancia = this.distancia / 1000;
                    this.duracion = this.duracion / 60;


                    let formData = new FormData();
                        formData.append('cooSalida', this.cooSalida[0] + "," + this.cooSalida[1]);
                        formData.append('cooDestino', this.cooDestino[0] + "," + this.cooDestino[1]);
                        formData.append('salida', this.salida);
                        formData.append('destino', this.destino);
                        formData.append('distancia', this.distancia);
                        formData.append('duracion', this.duracion);
                        formData.append('ocupantes', this.ocupantes);


                    const config = {
                        headers: { 'Content-Type': 'application/json' }
                    }
                    let response4;
                    try {
                        response4 = await axios.post(this.url + '/auth-api/viajes/crear', formData, config);
                    }catch(err){
                        console.log(err);

                    }

                    if(response4.data.length > 0){
                          //redirigir a la vista de eleccion de canciones
                        let code = response4.data[1];
                     await this.$router.push({name: 'conductor-elegir', params: {code: code}});
                      //  this.$router.push({name: 'perfil', params: {action: 'redirect-spotify'}});

                    }else{
                        this.$notify({
                            group: 'foo',
                            type: 'error',
                            title: 'No hay rutas!',

                        });
                    }



                } else {
                    this.$notify({
                        group: 'foo',
                        type: 'error',
                        title: 'Debe elegir una salida y un Destino',

                    });
                }
            }
        }
    }
</script>

<style>
    #map {
        width: 100%;
        height: 100vh
    }



</style>
