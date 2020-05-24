<template>
    <div>
        <notifications group="foo"/>
        <div
            class="container-fluid shadow p-4 mt-4 d-flex justify-content-around align-items-center flex-column flex-sm-row flex-md-row flex-lg-row flex-xl-row">

            <template v-if="showChoosedMenu">
                <a class="btn btn-dark text-white w-25 py-3 my-3" @click="choosedSong">Añadir canciones</a>

            </template>
            <template v-else>
                <a class="btn btn-dark text-white w-25 py-3 my-3" @click="choosedSong">Canciones añadidas </a>
                <a v-if="type === 'conductor'" class="btn btn-success text-white w-25 py-3 my-3  "
                   :class="{disabled:!buttonCreateEnable}" @click="guardarPlaylist">Ocupantes
                    listos
                    | Iniciar Playlist 😎</a>
                <a v-else class="btn btn-success text-white w-25 py-3 my-3" @click="guardarPlaylist">Listo 😎</a>
            </template>


        </div>
        <div class="container w-75 shadow p-4 mt-4" v-if="showSearch">

            <input type="text" class="form-control" v-model="search" placeholder="Buscar Canciones" @keyup="getSongs">
            <h6 v-if="minutosTotales > 0">Te quedan {{minutosTotales}} minutos de canciones</h6>
            <h6 v-else>No te quedan minutos</h6>

        </div>
        <div class="container main-songs shadow bg-light p-4 my-4" v-if="!showChoosedMenu">

            <div v-for="song in songs" :key="song.id"
                 class="container w-75 my-4 d-flex justify-content-around align-items-center flex-column flex-sm-row flex-md-row flex-lg-row flex-xl-row">
                <div class="song-img" :style="{backgroundImage: 'url(' + song.image+')'}"></div>
                <h5 class="title">{{song.title}}</h5>
                <button class="btn btn-dark  px-5 py-2" v-if="minutosTotales > 0" @click="saveSongs(song)">Añadir
                </button>
            </div>

            <hr>

        </div>
        <div v-else class="container main-songs shadow bg-light p-4 my-4">
            <div v-for="song in savedSongs" :key="song.id"
                 class="container w-75 my-4 d-flex justify-content-around align-items-center flex-column flex-sm-row flex-md-row flex-lg-row flex-xl-row">
                <div class="song-img" :style="{backgroundImage: 'url(' + song.image+')'}"></div>
                <h5 class="title">{{song.title}}</h5>
                <button class="btn btn-danger px-5 py-2" @click="deleteSongs(song)">Eliminar</button>
            </div>
            <hr>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tu playlist esta lista!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <a :href="playlistUrl">Haz click para reproducir tu playlist!</a>
                    </div>
                    <div class="modal-footer">
                        <router-link to="/home" type="button" class="btn btn-primary">Salir</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    import * as SpotifyWebApi from 'spotify-web-api-js';
    import moment from 'moment';
    export default {
        props: ["type"],
        data() {
            return {
                url: window.location.origin,
                search: '',
                token: '',
                songs: [],
                savedSongs: [],
                showSearch: true,
                showChoosedMenu: false,
                intervalo: null,
                minutosTotales: 0,
                pasajeros: 0,
                buttonCreateEnable: false,
                playlistUrl: '',
            }
        },
        mounted() {
            this.init();


        },

        methods: {
            async init() {

                //1. revisar si el usuario tiene asociada la cuenta de spotify
                //TODO Revisar si el usuario ha creado un viaje y si ese viaje no tiene asociada ya una playlist(Crear campo boolean, has_playlist)
                const has_playlist = await axios.get(this.url + "/auth-api/viajes/verify_playlist");
                console.log();
                if(has_playlist.data.response !== "no"){
                  await this.$router.push({path: '/viaje'});

                }else{
                    const responseDataAccount = await axios.get(this.url + "/auth-api/perfil");

                    let expiration = responseDataAccount.data.spotify_expiration;
                    let dateNow = moment();
                    let result = dateNow.diff(expiration) / 3600000;

                    if (responseDataAccount.data.spotify === null || result >= 1) {
                        await this.$router.push({name: 'perfil', params: {action: 'redirect-spotify'}});
                    } else {
                        const responseDataAccount = await axios.get(this.url + "/auth-api/perfil");
                        this.token = responseDataAccount.data.spotify;
                        const code = await axios.get(this.url + "/auth-api/viajes/getCode");
                        await this.getPasajeros();
                        this.minutosTotales = Math.round(code.data.duracion / this.pasajeros);
                        if (this.type === "conductor") {



                            this.$notify({
                                group: 'foo',
                                type: 'success',
                                title: 'Comparte este codigo con tus ocupantes',
                                duration: 100000,
                                text: "<b>" + code.data.travel_code + "</b>"
                            });
                            this.intervalo = setInterval(this.cuenta, 1000);
                        }


                    }

                }

            },
            getSongs(e) {
                if (this.search.length === 0) this.songs = [];
                if (this.search.length > 3 && e.keyCode !== 8) {

                    this.songs = [];
                    let vm = this;
                    let spotifyApi = new SpotifyWebApi();
                    spotifyApi.setAccessToken(this.token);

                    spotifyApi.searchTracks(this.search, {limit: 5})
                        .then(
                            function (response) {
                                console.log(response);
                                if (vm.songs.length === 0) {
                                    for (let i = 0; i < response.tracks.items.length; i++) {
                                        vm.songs.push({
                                            id: response.tracks.items[i].uri,
                                            title: response.tracks.items[i].name,
                                            image: response.tracks.items[i].album.images[1].url,
                                            duration: response.tracks.items[i].duration_ms,
                                        });
                                    }
                                }

                            },
                            function (err) {
                                console.error(err);
                            }
                        );
                }
            },
            saveSongs(song) {

                this.savedSongs.push(song);
                this.songs = this.songs.filter(x => x !== song);
                this.minutosTotales -= Math.round(song.duration / 60000);
                console.log(this.savedSongs);
                const arra = [];
                for (let v of this.savedSongs) {
                    arra.push(v.id);
                }
                console.log(arra);
            },
            deleteSongs(song) {
                this.savedSongs = this.savedSongs.filter(x => x !== song);
                this.songs.push(song);
                this.minutosTotales += Math.round(song.duration / 60000);
            },
            choosedSong() {
                this.showChoosedMenu = !this.showChoosedMenu;
                this.showSearch = !this.showSearch;
            },
            async cuenta() {


                const pasa = await axios.get(this.url + "/auth-api/viajes/passengers")
                console.log(pasa.data);
                if (pasa.data.pasajeros_listos === this.pasajeros - 1) {
                    clearInterval(this.intervalo);
                    this.buttonCreateEnable = true;
                }

            },
            async getPasajeros() {

                const pasa = await axios.get(this.url + "/auth-api/viajes/passengers")
                this.pasajeros = pasa.data.pasajeros_total;
            },
            async guardarPlaylist() {

                if (this.savedSongs.length > 0) {
                    let formData = new FormData();

                    formData.append('songs', JSON.stringify(this.savedSongs));
                    formData.append('type', this.type);
                    const config = {
                        headers: {'Content-Type': 'application/json'}
                    }
                    axios.post(this.url + '/auth-api/addSongs', formData, config)
                        .then(response => {

                            if (this.type === "conductor") {
                                const data = response.data;
                                const uris = [];
                                Object.entries(data).forEach(([key, val]) => {
                                    uris.push(val.song);
                                });
                                let spotifyApi = new SpotifyWebApi();
                                spotifyApi.setAccessToken(this.token);
                                //en caso de deploy sustituir user por el response de la peticion al endpoint /me
                                moment.locale('es');
                                moment.locale();
                                spotifyApi.createPlaylist("manusav98", {
                                    'public': true,
                                    'name': 'Viaje del ' + moment().format('L')
                                })
                                    .then(response => {
                                        let idPlaylist = response.id;
                                        this.playlistUrl = response.external_urls.spotify;

                                        spotifyApi.addTracksToPlaylist(idPlaylist, uris).then(response => console.log(response));
                                        $(document).ready(function(){
                                            $("#exampleModal").modal('show');
                                        });
                                    });

                            } else {
                                this.$router.push({name: 'home', params: {listo: 'ocupante-listo'}});

                            }

                        });
                }else{
                    this.$notify({
                        group: 'foo',
                        type: 'error',
                        title: 'Debes agregar al menos una cancion',
                        duration: 10000,

                    });
                }
            }
        }
    }

</script>

<style scoped>
    .song-img {
        width: 100px;
        height: 100px;

        background-position: center;
        background-size: cover;
    }

    .main-songs {
        min-height: 100vh;
        height: auto;
    }
</style>
