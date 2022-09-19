<template>
<div>
    <Header/>
    <div class="container-fluid">
        <div class="row">
        <Sidebar/>
          <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
              <h1 class="h2">Dashboard</h1>
            </div>
            <h5>Welcome {{firstname}} {{lastname}} !</h5>
          </main>
        </div>
    </div>
</div>
</template>

<script>
import Header from './Layout/Header.vue';
import Sidebar from './Layout/Sidebar.vue';
export default{
    data(){
        return{
            firstname: '',
            lastname: ''
        }
    },
    components: {
        Header,
        Sidebar
    },
    created() {
        var user = JSON.parse(localStorage.getItem('user'));
        this.firstname = user.first_name; 
        this.lastname = user.last_name;
    }
}
</script>