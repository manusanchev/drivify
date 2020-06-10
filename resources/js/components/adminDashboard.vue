<template>
  <div>
     <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="s border-right" id="sidebar-wrapper">
          <div class="sidebar-heading text-white">Administrador</div>
          <div class="list-group list-group-flush">
            <router-link  to="/admin/dashboard/users" class="list-group-item list-group-item-action s text-white">Usuarios</router-link>
            <router-link to="/admin/dashboard/travels" class="list-group-item list-group-item-action s text-white">Viajes</router-link>
          </div>
        </div>
        <!-- /#sidebar-wrapper -->
    
        <!-- Page Content -->
        <div id="page-content-wrapper">
    
          <div class="container-fluid mt-5">
            
            <router-view ></router-view>

         </div>
        <!-- /#page-content-wrapper -->
    
      </div>
  </div>
  </div>
</template>

<script>
export default {
  mounted() {
      if(window.location.pathname === "/admin/dashboard"){
        this.$router.push({ path: '/admin/dashboard/users' })
      }
       
  },
}
</script>

<style scoped>
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