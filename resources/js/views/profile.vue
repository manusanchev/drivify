<template>

    <div>
        <profile-data></profile-data>
        <notifications group="foo"/>
        <div
            class="container bg-light d-flex justify-content-between shadow align-items-center flex-column flex-md-row p-5 mt-5 mb-5 r-menu">
            <div class="container d-flex flex-column form-group">

                <div class="container">
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
                    <h3 class="text-center">Detalles personales </h3>
                    <hr>
                    <div class="d-flex flex-column">
                        <div class="row w-75 p-2 m-auto text-center">
                            <div class="col-12 col-md-4 pb-4">
                                <h5>Nombre y Apellidos</h5>
                            </div>
                            <div class="col-12 col-md-4 pb-4">
                                <p v-if="profile.name!=null && !editarNombreShow" class="text-primary">
                                    {{profile.name}}</p>
                                <input v-else-if="editarNombreShow" type="text" v-model="editProfile.name"
                                       class="form-control">
                                <p class="text-primary" v-else>Introduce tu nombre y apellidos</p>
                            </div>
                            <div class="col-12  col-md-4 ">
                                <button v-if="editarNombreShow" v-on:click="guardarNombre" class="btn btn-primary">
                                    Guardar
                                </button>
                                <button v-if="editarNombreShow" v-on:click="editarNombre" class="btn btn-danger">
                                    Cancelar
                                </button>
                                <button v-else v-on:click="editarNombre" class="btn btn-dark">Editar</button>

                            </div>

                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <div class="row w-75 p-2 m-auto text-center">
                            <div class="col-12 col-md-4 pb-4">
                                <h5>Usuario</h5>
                            </div>
                            <div class="col-12  col-md-4 pb-4">
                                <p v-if="profile.username!=null && !editarUsuarioShow" class="text-primary">
                                    {{profile.username}}</p>
                                <input v-else-if="editarUsuarioShow" type="text" v-model="editProfile.username"
                                       class="form-control">
                                <p v-else class="text-primary">Introduce tu usuario</p>
                            </div>
                            <div class="col-12  col-md-4 ">
                                <button v-if="editarUsuarioShow" v-on:click="guardarUsuario" class="btn btn-primary">
                                    Guardar
                                </button>
                                <button v-if="editarUsuarioShow" v-on:click="editarUsuario" class="btn btn-danger">
                                    Cancelar
                                </button>
                                <button v-else v-on:click="editarUsuario" class="btn btn-dark">Editar</button>
                            </div>

                        </div>
                    </div>
                    <form @submit.prevent="uploadImage">
                        <div class="d-flex flex-column">
                            <div class="row w-75 p-2 m-auto text-center">
                                <div class="col-12 col-md-4 pb-4">
                                    <h5>Foto de perfil</h5>
                                </div>
                                <div class="col-12 col-md-4 pb-4">

                                    <input type="file" class="custom-file-input" id="inputGroupFile01"
                                           aria-describedby="inputGroupFileAddon01" v-on:change="imageChange">
                                    <label class="custom-file-label" for="inputGroupFile01"></label>

                                </div>
                                <div class="col-12  col-md-4 ">
                                    <button class="btn btn-dark">Subir</button>

                                </div>

                            </div>
                        </div>
                    </form>
                </div>

                <div class="container">
                    <h3 class="text-center">Permisos aplicaciones</h3>
                    <hr>
                    <div class="d-flex flex-column">
                        <div class="row w-75 p-2 m-auto text-center">
                            <div class="col-12 col-md-6 pb-4">
                                <h5>Otorga permisos a spotify</h5>
                            </div>
                            <div class="col-12  col-md-6 ">
                                <button class="btn btn-success" @click="vincularSpotifyGetAccess">Vincular
                                    Cuenta
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <h3 class="text-center">Acciones de la cuenta</h3>
                    <hr>
                    <div class="d-flex flex-column">
                        <div class="row w-75 p-2 m-auto text-center">
                            <div class="col-12">
                                <button class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">Borrar
                                    Cuenta
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmacion de eliminacion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Esta a punto de eliminar su cuenta, lo que significa que sus datos seran borrados para
                            siempre de nuestros servidores, por lo que es una accion
                            irreversible</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" v-on:click="deleteAccount">Eliminar</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

</template>


<script>

    import * as SpotifyWebApi from "spotify-web-api-js";

    export default {
        props: ["action"],
        data() {
            return {
                url: window.location.origin,
                profile: {},
                editProfile: {},
                editarNombreShow: false,
                editarUsuarioShow: false,
                CLIENT_ID: "78222442429d4cac85e7be9ac7a4f13f",
                CLIENT_SECRET: "7ee859747e584c04abe510feaca410b7",
                REDIRECT_URI: "http:%2F%2Flocalhost:80%2Fperfil%2F",
            }
        },
        mounted() {
            this.getDataProfile();
            if (window.location.hash) {
                this.vincularSpotify(window.location.hash.substring(1));
            }

            if (this.action === "redirect-spotify") {
                this.$notify({
                    group: 'foo',
                    type: 'warn',
                    title: 'Debes vincular tu cuenta de Spotify para continuar',

                });
            }
        },
        methods: {
            getDataProfile() {
                axios.get(this.url + "/auth-api/perfil")
                    .then(response => {
                        this.profile = response.data;
                    });
            },
            deleteAccount() {
                axios.delete(this.url + "/auth-api/perfil/eliminar")
                    .then(response => window.location.reload())
                    .catch(error => window.location.reload());
            },
            editarNombre() {
                this.editarNombreShow = !this.editarNombreShow;
                this.editProfile.name = this.profile.name;
            },
            guardarNombre() {
                this.editarNombreShow = false;

                let vm = this;
                axios.put(this.url + "/auth-api/perfil/edit", {
                    name: vm.editProfile.name,
                })
                    .then(response => {

                        if (response.data[1] === 200) {
                            this.$notify({
                                group: 'foo',
                                type: 'success',
                                title: 'El nombre se ha actualizado correctamente',

                            });
                            this.profile.name = this.editProfile.name;
                        } else {
                            this.$notify({
                                group: 'foo',
                                type: 'error',
                                title: 'No se ha podido actualizar',
                            });
                        }

                    })
                    .catch(error => {
                        this.$notify({
                            group: 'foo',
                            type: 'error',
                            title: 'No se ha podido actualizar',
                        });
                    });
            },
            editarUsuario() {
                this.editarUsuarioShow = !this.editarUsuarioShow;
                this.editProfile.username = this.profile.username;
            },
            guardarUsuario() {
                this.editarUsuarioShow = false;
                let vm = this;
                axios.put(this.url + "/auth-api/perfil/edit", {
                    username: vm.editProfile.username,
                }).then(response => {
                    console.log(response.data);
                    if (response.data[1] === 200) {
                        this.$notify({
                            group: 'foo',
                            type: 'success',
                            title: 'El usuario se ha actualizado correctamente',
                        });

                        this.profile.username = this.editProfile.username;
                    } else {
                        this.$notify({
                            group: 'foo',
                            type: 'error',
                            title: 'No se ha podido actualizar',
                        });
                    }

                })
                    .catch(error => {
                        this.$notify({
                            group: 'foo',
                            type: 'error',
                            title: 'No se ha podido actualizar',
                        });
                    });

            },
            imageChange(e) {

                this.editProfile.image = e.target.files[0];

            },
            uploadImage() {

                if (this.editProfile.image) {
                    const config = {
                        headers: {'enctype': 'multipart/form-data'}
                    }
                    let vm = this;
                    let formData = new FormData();

                    formData.append('image', this.editProfile.image);

                    axios.post(this.url + "/auth-api/perfil/uploadImage", formData, config)
                        .then(response => {

                            if (response.data.success === 200) {
                                this.$notify({
                                    group: 'foo',
                                    type: 'success',
                                    title: 'La imagen se ha actualizado correctamente',

                                });
                                vm.profile.username = vm.editProfile.name;
                                window.location.reload();
                            } else {
                                this.$notify({
                                    group: 'foo',
                                    type: 'error',
                                    title: 'No se ha podido agregar',
                                    text: 'Debe ser una imagen'
                                });
                            }

                        })
                        .catch(error => {
                            this.$notify({
                                group: 'foo',
                                type: 'error',
                                title: 'No se ha podido agregar',
                                text: 'Debe ser una imagen'
                            });
                        });

                }

            },
            vincularSpotifyGetAccess() {

                const spotifyLogin = `https://accounts.spotify.com/authorize?client_id=${this.CLIENT_ID}&redirect_uri=${this.REDIRECT_URI}&scope=user-read-private%20playlist-read-private%20playlist-modify-public%20user-read-email&response_type=token&state=123`;
                window.location.href = spotifyLogin;

            },
             vincularSpotify(hash) {
                let result = {};
                hash.split('&').forEach(item => {
                    result[item.split('=')[0]] = decodeURIComponent(item.split('=')[1]);
                });
                //


                var data = {
                    access_token: result.access_token,
                }


               axios.post(this.url+'/auth-api/spotify',data)
                .then(response => {

                        if(response.data.success === 200){
                            window.history.go(-2);

                        }else{
                           window.location.href = this.url+"/perfil";
                        }
                })

            }

        }


    }
</script>

<style>

</style>
