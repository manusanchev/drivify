<template>
    <div>
        <div class="container shadow bg-light p-4 my-4">
            <h1 class="text-center">Mis logros</h1>
            <div class="row d-flex justify-content-around">
                <div v-for="(logro,index) in misLogros" :key="index"
                         class=" d-flex justify-content-around align-items-center flex-column m-3">
                        <div class="img" :style="{backgroundImage: 'url(/images/' + logro.img+')'}"></div>
                        <p class="mt-2">{{logro.name}}</p>
                       <button class="btn bg-success text-white disabled">Conseguido</button>
                    </div>
            </div>
        </div>
        <hr>

        <div class="container shadow bg-light p-4 my-4">
            <div class="row">
                <div class="row  d-flex justify-content-around">
                    <div v-for="logro in logros" :key="logro.id"
                         class=" d-flex justify-content-around align-items-center flex-column m-3">
                        <div class="img" :style="{backgroundImage: 'url(/images/' + logro.img+')'}"></div>
                        <p class="mt-2">{{logro.name}}</p>
                        <button class="btn btn-dark" @click="addAward(logro)">{{logro.price}} puntos</button>
                       
                    </div>
                </div>

            </div>


        </div>


    </div>

</template>

<script>
    export default {
        data() {
            return {
                url: window.location.origin,
                misLogros: [],
                logros: [],
                points: 0,

            }
        },
        async mounted() {
            await axios.get(this.url + "/auth-api/awards")
                .then(response => {
                    this.logros = response.data;
                })
            await axios.get(this.url + "/auth-api/user")
                .then(response => {
                   
                    this.points = response.data.points;
                    for (let [key, value] of Object.entries(this.logros)) {
               
                        if(this.points >= value.price){
                            this.misLogros.push(value);
                        }
                         
                    }

                   
            })
            console.log(this.misLogros);
        
        }, 
        methods: {
            filter(item){
               console.log(item);
            }
        }
    }
</script>

<style scoped>
    .img {
        width: 100px;
        height: 100px;
    }
</style>
