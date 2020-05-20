<template>
    <div>
        <div class="container-fluid shadow p-4 mt-4 d-flex justify-content-around align-items-center flex-column flex-sm-row flex-md-row flex-lg-row flex-xl-row">
            <a class="btn btn-dark text-white w-25 py-3 my-3">Canciones añadidas </a>
            <a class="btn btn-dark text-white w-25 py-3 my-3">Mis playlist</a>

            <a v-if="type === 'conductor'" class="btn btn-success text-white w-25 py-3 my-3 disabled ">Ocupantes listos | Iniciar Playlist 😎</a>
            <a v-else class="btn btn-success text-white w-25 py-3 my-3">Listo 😎</a>

        </div>
        <div class="container w-75 shadow p-4 mt-4">

                <input type="text" class="form-control" v-model="search" placeholder="Buscar Canciones" @keyup="getSongs">
                <h6>Solo puedes elegir {{numberSongs}} minutos para añadir canciones</h6>

        </div>

        <div class="container main-songs shadow bg-light p-4 my-4">

            <div v-for="song in songs" :key="song.id" class="container w-75 my-4 d-flex justify-content-around align-items-center flex-column flex-sm-row flex-md-row flex-lg-row flex-xl-row">
                <div class="song-img" :style="{backgroundImage: 'url(' + song.image+')'}"></div>
                <h5 class="title">{{song.title}}</h5>
                <button class="btn btn-dark px-5 py-2">Añadir</button>
            </div>
            <hr>

        </div>


    </div>
</template>


<script>
    import * as SpotifyWebApi from 'spotify-web-api-js';
    export default {
        props: ["type"],
        data(){
            return{
                url: window.location.origin,
                search:'',
                token: '',
                songs: [],
                savedSongs: [],
            }
        },
        mounted() {
            this.init();
        },
        computed: {
          numberSongs: function () {

          }
        },
        methods:{
            async init(){
                //1. revisar si el usuario tiene asociada la cuenta de spotify

                const responseDataAccount  = await axios.get(this.url+"/auth-api/perfil");
                if(responseDataAccount.data.spotify === null){
                    await this.$router.push({name: 'perfil', params: {action: 'redirect-spotify'}});
                }else{
                   this.token = responseDataAccount.data.spotify;
                }

            },
            getSongs(){

                if(this.search.length >3){
                    this.songs = [];
                    let vm = this;
                    let spotifyApi = new SpotifyWebApi();
                    spotifyApi.setAccessToken(this.token);

                    spotifyApi.searchTracks(this.search, { limit: 5 })
                    .then(
                        function (response) {
                            if(vm.songs.length === 0){
                                for(let i=0; i<response.tracks.items.length; i++){
                                    vm.songs.push({
                                        id: response.tracks.items[i].id,
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
            }

        }

    }
</script>

<style scoped>
    .song-img{
        width: 100px;
        height: 100px;

        background-position: center;
        background-size: cover;
    }
    .main-songs{
        min-height: 100vh;
        height: auto;
    }
</style>
