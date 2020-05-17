<template>

    <div>
        <profile-data></profile-data>
        <div class="container bg-light d-flex justify-content-between shadow align-items-center flex-column flex-md-row p-5 mt-5 mb-5 r-menu">
            <div class="container d-flex flex-column form-group">
                <!--DetallesComponent-->
                <div class="container">
                    <router-link to="/home"> < Volver</router-link>
                    <h3 class="text-center">Detalles personales</h3>
                    <hr>
                    <div class="d-flex flex-column">
                        <div class="row w-75 p-2 m-auto text-center">
                            <div class="col-12 col-md-4 pb-4">
                                <h5>Nombre y Apellidos</h5>
                            </div>
                            <div class="col-12 col-md-4 pb-4">
                                <p class="text-primary">Manuel Sánchez Velázquez</p>
                                <!--<input type="text" class="form-control">-->
                            </div>
                            <div class="col-12  col-md-4 ">
                                <button class="btn btn-dark">Editar</button>
                                <!--<button class="btn btn-dark">Guardar</button>-->
                            </div>

                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <div class="row w-75 p-2 m-auto text-center">
                            <div class="col-12 col-md-4 pb-4">
                                <h5>Usuario</h5>
                            </div>
                            <div class="col-12  col-md-4 pb-4">
                                <p class="text-primary">manusav</p>
                            </div>
                            <div class="col-12  col-md-4 ">
                                <button class="btn btn-dark">Editar</button>
                            </div>

                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <div class="row w-75 p-2 m-auto text-center">
                            <div class="col-12 col-md-4 pb-4">
                                <h5>Contraseña</h5>
                            </div>
                            <div class="col-12  col-md-4 pb-4">
                                <p class="text-primary">***************</p>
                            </div>
                            <div class="col-12  col-md-4 ">
                                <button class="btn btn-dark">Editar</button>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <div class="row w-75 p-2 m-auto text-center">
                            <div class="col-12 col-md-4 pb-4">
                                <h5>Foto de perfil</h5>
                            </div>
                            <div class="col-12 col-md-4 pb-4">
                                <!--foto de perfil-->

                                <input type="file" class="custom-file-input" id="inputGroupFile01"
                                       aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label" for="inputGroupFile01"></label>

                            </div>
                            <div class="col-12  col-md-4 ">
                                <button class="btn btn-dark">Subir</button>
                                <!--<button class="btn btn-dark">Guardar</button>-->
                            </div>

                        </div>
                    </div>
                </div>
                <!--/DetallesComponent-->
                <!--PermisosComponent-->
                <div class="container">
                    <h3 class="text-center">Permisos aplicaciones</h3>
                    <hr>
                    <div class="d-flex flex-column">
                        <div class="row w-75 p-2 m-auto text-center">
                            <div class="col-12 col-md-6 pb-4">
                                <h5>Otorga permisos a spotify</h5>
                            </div>
                            <div class="col-12  col-md-6 ">
                                <button class="btn btn-success">Log in with spotify</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/PermisosComponent-->
                <!--AccionesComponent-->
                <div class="container">
                    <h3 class="text-center">Acciones de la cuenta</h3>
                    <hr>
                    <div class="d-flex flex-column">
                        <div class="row w-75 p-2 m-auto text-center">
                            <div class="col-12">
                                <button class="btn btn-danger">Borrar Cuenta</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/AccionesComponent-->
            </div>
        </div>
        <!--/AjustesComponent-->
    </div>

</template>


<script>
    export default {

    }
</script>

<style>

</style>
