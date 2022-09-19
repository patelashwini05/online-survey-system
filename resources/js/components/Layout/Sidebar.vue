<template>
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3">
              <ul class="nav flex-column">
                <li class="nav-item">
                  <router-link class="nav-link active" aria-current="page" to="/dashboard">Dashboard</router-link>
                  </a>
                </li>
                <li class="nav-item" v-if="user_type == 'management'">
                  <router-link class="nav-link" to="/user-list">Users</router-link>
                </li>
                <li class="nav-item" v-if="user_type == 'management'">
                  <router-link class="nav-link" to="/survey-list">Survey</router-link>
                </li>
                <li class="nav-item" v-if="user_type == 'staff'">
                  <router-link class="nav-link" to="/surveys">Take Survey</router-link>
                </li>
              </ul>
            </div>
    </nav>
</template>

<script>
  export default{
    data(){
      return{
        user_type: ''
      }
    },
    created(){
      var user = JSON.parse(localStorage.getItem('user'));
      this.user_type = user.user_type;
    }
  }
</script>