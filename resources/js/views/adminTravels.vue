<template>
   <div>
            <table class="table table-striped table-dark container-fluid">
                <thead>
                  <tr>
                    <th scope="col">id</th>
                    <th scope="col">Salida</th>
                    <th scope="col">Destino</th>
                    <th scope="col">fecha</th>
                    <th scope="col">Pasajeros</th>
                    <th scope="col">Distancia</th>
                    <th scope="col">Duracion</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="travel in travels.data" :key="travel.id">
                    <th scope="row">{{travel.id}}</th>
                    <th scope="row">{{travel.departure}}</th>
                    <td>{{travel.destination}}</td>
                    <td>{{travel.travel_date}}</td>
                    <td>{{travel.passengers}}</td>
                    <td>{{travel.distance}} Kms</td>
                    <td>{{travel.duration}} Minutos</td>
                  </tr>
                </tbody>
              </table>
            <div class="container d-flex justify-content-around align-items-center">
                <div class="p-3 bg-light page-link " @click="search(travels.prev_page_url)">Prev</div>
                <div class="p-3 bg-light">Pagina {{travels.current_page}} / {{travels.last_page}}</div>
                <div class="p-3 bg-light page-link" @click="search(travels.next_page_url)">Next</div>
     
            </div>
          </div>
</template>

<script>
export default {
        data() {
            return {
                url: window.location.origin,
                travels: [],
            }
        },
        async mounted() {
            const responseTravels=  await axios.get(this.url +'/auth-api/admin/viajes');
            this.travels = responseTravels.data;
        },
        methods: {
            async search(page) {
                const response = await axios.get(page);
                this.travels = response.data;
        },
        }
       
}
</script>

<style scoped>
.page-link{
    cursor: pointer;
}
 body {
    overflow-x: hidden;
  }
  .s{
      background-color: #18222c;
  }
  .s a:hover{
      background-color: #304357;
  }
  .s a:focus{
    background-color: #243241;
}
  #sidebar-wrapper {
    min-height: 100vh;
    width: 11rem;
    -webkit-transition: margin .25s ease-out;
    -moz-transition: margin .25s ease-out;
    -o-transition: margin .25s ease-out;
    transition: margin .25s ease-out;
  }
  
  #sidebar-wrapper .sidebar-heading {
    padding: 0.875rem 1.25rem;
    font-size: 1.2rem;
  }
  
  #sidebar-wrapper .list-group {
    width: 10rem;
  }
  
  #page-content-wrapper {
    min-width: 100vw;
  }
  
  #wrapper.toggled #sidebar-wrapper {
    margin-left: 0;
  }
  
  @media (min-width: 768px) {
    #sidebar-wrapper {
      margin-left: 0;
    }
  
    #page-content-wrapper {
      min-width: 0;
      width: 100%;
    }
  
    #wrapper.toggled #sidebar-wrapper {
      margin-left: 15rem;
    }
  }

</style>