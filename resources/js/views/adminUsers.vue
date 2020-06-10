<template>
  <div>
    
        <notifications group="foo"/>
            <table class="table table-striped table-dark container-fluid">
                <thead>
                  <tr>
                    <th scope="col">id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">username</th>
                    <th scope="col">email</th>
                    <th scope="col">email verificado</th>
                    <th scope="col">rol</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>
                  </tr>
                </thead>
                <tbody>
                  
                  <tr v-for="user in users.data" :key="user.id" :class="{editing: user == editedUser}" v-cloak>
                    <td>{{user.id}}</td>
                        <td>
                           <div class="view">
                              {{user.name}}
                          </div>
                          <div class="edit">
                                <input type="text" class="form-control" v-model="user.name">
                          </div>
                        </td>
                        <td>
                          <div class="view">
                              {{user.username}}
                          </div>
                          <div class="edit">
                             <input type="text" class="form-control edit" v-model="user.username">
                          </div>
                        </td>
                        <td>{{user.email}}</td>
                        <td>
                          <span v-if="user.email_verified_at!=null" class="badge badge-secondary badge-success p-2">Verificado</span>
                          <span v-else class="badge badge-secondary badge-danger p-2">No verificado</span>
                        </td>
                        <td>
                          <div class="view">
                            {{user.role}}
                          </div>
                          <div class="edit">
                           <select class="form-control" v-model="user.role">
                            <option value="admin">admin</option>
                            <option value="traveler">traveler</option>
                          </select>
                          </div>
                        </td>
                        <td>
                          <div class="view">
                            <button  type="button" class="btn btn-light" @click="editUser(user)">Editar</button>
                          </div>
                          <div class="edit">
                            <button type="button" class="btn btn-success" @click="saveUser(user)">Guardar</button>
                          </div>
                        </td>
                        <td>
                          <div class="view">
                              <button type="button" class="btn btn-danger" @click="deleteUser(user)">Eliminar</button>
                          </div>
                          <div class="edit">
                                <button type="button" class="btn btn-info" @click="editUser(null)">Cancelar</button>
                          </div>
                           
                        
                        </td>
                    
                  </tr>
                </tbody>
              </table>
              <div class="container d-flex justify-content-around align-items-center">
                <div class="p-3 bg-light page-link " @click="search(users.prev_page_url)">Prev</div>
                <div class="p-3 bg-light">Pagina {{users.current_page}} / {{users.last_page}}</div>
                <div class="p-3 bg-light page-link" @click="search(users.next_page_url)">Next</div>
     
            </div>
          </div>
     
</template>

<script>
// /admin/users
// /admin/viajes
// /admin/users/edit
// /admin/users/delete
export default {
  data() {
    return {
      
        users: [],
        url: window.location.origin,
        
    editedUser: null
        
    }
  },
  async mounted() {
        const responseUsers =  await axios.get(this.url +'/auth-api/admin/users');
        responseUsers.data.data.editing = false;
        this.users = responseUsers.data;
        console.log(this.users);
  },
  methods: {
      async search(page) {
                page = page
                const response = await axios.get(page);
                this.users = response.data;
      },
      editUser(user){
          
        this.beforEditCache = user
        this.editedUser = user
      },
      saveUser(user){
        let formData = new FormData();
        formData.append('name', user.name);
        formData.append('username', user.username);
        formData.append('role', user.role);
        formData.append('id', user.id);

        axios.post(this.url+ "/auth-api/admin/users/edit", formData)
        .then(response => {
            if(response.data[1] ==200){
                this.$notify({
                    group: 'foo',
                    type: 'success',
                    title: 'El usuario se ha actualizado correctamente',
              });

            }
        });


        this.beforEditCache = null;
        this.editedUser = null
      },
      deleteUser(user){
       let formData = new FormData();
          formData.append('id', user.id);
           axios.post(this.url+ "/auth-api/admin/users/delete", formData)
        .then(response => {
            if(response.data[1] ==200){
                this.$notify({
                    group: 'foo',
                    type: 'success',
                    title: 'El usuario se ha eliminado correctamente',
              });
              this.users.data = this.users.data.filter((item) => item.id !== user.id);
       

            }
        });

      
      }
  }


}
</script>

<style scoped>
[v-cloak] {
      display: none;
    }
    .edit {
      display: none;
    }
    .editing .edit {
      display: block
    }
    .editing .view {
      display: none;
    }
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