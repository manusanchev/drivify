<template>
    <div>
        <notifications group="foo"/>
        <div class="main container bg-light shadow mt-5 mb-5  r-menu">
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
            <form @submit.prevent="comprobarCodigo" class="container d-flex align-items-center flex-column pb-5 mb-5">
                <h1 class="pb-5 text-center">Introduce el codigo</h1>
                <input type="text" class="form-control w-100 p-4 m-3" v-model="codigo" placeholder="Codigo">
                <input type="submit" class="btn btn-lg w-100 p-3 shadow btn-dark w-50" value="Entrar en la sala">
            </form>
        </div>

    </div>
</template>


<script>
    export default {
        data(){
            return {
                codigo: '',
                url: window.location.origin
            }
        },
        methods: {
            async comprobarCodigo(){
                if(this.codigo !== ''){

                    const config = {
                        headers: { 'Content-Type': 'application/json' }
                    }
                    const data = {
                        codigo: this.codigo
                    }

                    try {
                        const response = await axios.post(this.url+"/auth-api/viajes/code", data, config);
                        console.log(response.data);
                        if(response.data[1] === 200){
                            this.$router.push({path: 'ocupante/elegir'});
                        }else if(response.data[1] === 1){
                            this.$notify({
                                group: 'foo',
                                type: 'error',
                                title: 'La sala esta completa',
                                duration: 10000,
                            });
                        }else{
                            this.$notify({
                                group: 'foo',
                                type: 'error',
                                title: 'El codigo introducido no es valido',

                            });
                        }
                    }catch (err) {
                        this.$notify({
                            group: 'foo',
                            type: 'error',
                            title: 'El codigo introducido no es valido',

                        });
                    }


                }else{
                    this.$notify({
                        group: 'foo',
                        type: 'error',
                        title: 'Debe introducir el codigo del conductor',

                    });
                }

            }
        }
    }
</script>


<style scoped>
    .main{
        height: 75vh;
    }
</style>
