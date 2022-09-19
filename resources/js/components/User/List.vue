<template>
<div>
<Header/>
<div class="container-fluid">
        <div class="row">
          <Sidebar/>
          <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <br>
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addUserModal">Add User</button>
            <h2 class="text-center">User List</h2>
            <div class="table-responsive">
              <table class="table table-striped table-sm">
                <thead>
                  <tr>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">User Type</th>
                    <th scope="col">Status</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="user in users" :key="user.id">
                    <td>{{ user.first_name }}</td>
                    <td>{{ user.last_name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.user_type }}</td>
                    <td>{{ user.status }}</td>
                    <td>{{ moment(user.created_at).format("DD-MM-YYYY") }}</td>
                    <td>{{ moment(user.updated_at).format("DD-MM-YYYY") }}</td>
                    <td>
                        <button class="btn btn-success btn-sm" :value="user.id" data-bs-toggle="modal" data-bs-target="#editUserModal" @click="getUserDetails(user.id)">Edit</button>
                        <button class="btn btn-danger btn-sm" :value="user.id" @click="deleteUser(user.id)">Delete</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </main>
        </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-uppercase" id="exampleModalLabel">ADD USER</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="adduserform">
      <div class="modal-body">
        <div class="row">
            <div class="col-lg-4">
                <label>First Name</label>
            </div>
            <div class="col-lg-8">
                <input type="text" class="form-control" placeholder="Enter your first name" v-model="user.first_name"/>
                <br>
            </div>
            <div class="col-lg-4">
              <label>Last Name</label>
            </div>
            <div class="col-lg-8">
              <input type="text" class="form-control" placeholder="Enter your last name" v-model="user.last_name"/>
              <br>
            </div>
            <div class="col-lg-4">
              <label>Email</label>
            </div>
            <div class="col-lg-8">
              <input type="text" class="form-control" placeholder="Enter your email address" v-model="user.email"/>
              <br>
            </div>
            <div class="col-lg-4">
              <label>Password</label>
            </div>
            <div class="col-lg-8">
              <input type="password" class="form-control" placeholder="Enter your password" v-model="user.password"/>
              <br>
            </div>
            <div class="col-lg-4">
              <label>User Type</label>
            </div>
            <div class="col-lg-8">
              <select class="form-control" v-model="user.user_type">
                <option value="" selected>Select User Type</option>
                <option value="management">Management</option>
                <option value="staff">Staff</option>
              </select>
              <br>
            </div>
            <div class="col-lg-4">
              <label>Status</label>
            </div>
            <div class="col-lg-8">
              <select class="form-control" v-model="user.status">
                <option value="" selected>Select User Status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
              </select>
              <br>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" @click="submit">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-uppercase" id="exampleModalLabel">EDIT USER</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="edituserform">
      <input type="hidden" v-model="id"/>
      <div class="modal-body">
        <div class="row">
            <div class="col-lg-4">
                <label>First Name</label>
            </div>
            <div class="col-lg-8">
                <input type="text" class="form-control" placeholder="Enter your first name" v-model="user.first_name"/>
                <br>
            </div>
            <div class="col-lg-4">
              <label>Last Name</label>
            </div>
            <div class="col-lg-8">
              <input type="text" class="form-control" placeholder="Enter your last name" v-model="user.last_name"/>
              <br>
            </div>
            <div class="col-lg-4">
              <label>Email</label>
            </div>
            <div class="col-lg-8">
              <input type="text" class="form-control" placeholder="Enter your email address" v-model="user.email"/>
              <br>
            </div>
            <!-- <div class="col-lg-4">
              <label>Password</label>
            </div>
            <div class="col-lg-8">
              <input type="password" class="form-control" placeholder="Enter your password" v-model="user.password"/>
              <br>
            </div> -->
            <div class="col-lg-4">
              <label>User Type</label>
            </div>
            <div class="col-lg-8">
              <select class="form-control" v-model="user.user_type">
                <option value="" selected>Select User Type</option>
                <option value="management">Management</option>
                <option value="staff">Staff</option>
              </select>
              <br>
            </div>
            <div class="col-lg-4">
              <label>Status</label>
            </div>
            <div class="col-lg-8">
              <select class="form-control" v-model="user.status">
                <option value="" selected>Select User Status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
              </select>
              <br>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" @click="update">Update</button>
      </div>
      </form>
    </div>
  </div>
</div>

</div>
</template>

<script>
import Header from '../Layout/Header.vue';
import Sidebar from '../Layout/Sidebar.vue';
import moment from "moment";
import $ from 'jquery';

export default{
    components: {
        Header,
        Sidebar
    },
    data(){
        return{
            users: [],
            moment: moment,
            user:{
              first_name: '',
              last_name: '',
              email: '',
              password: '',
              user_type: '',
              status: ''
            },
            token: '',
            id: ''
        }
    },
    created(){
        const token = localStorage.getItem('token');
        this.token = token;
        this.getUserList();
    },
    methods:{
      getUserList(){
        axios.get('http://localhost:8000/api/user/list',{
            headers:{
                Authorization: `Bearer ${this.token}`
            }
        })
        .then(response=>{
            this.users = response.data.data;
        }).catch(e=>{
            console.log(e);
        });
      },
      submit(){
       axios.post('http://localhost:8000/api/user/add',{
          first_name: this.user.first_name,
          last_name: this.user.last_name,
          email: this.user.email,
          password: this.user.password,
          user_type: this.user.user_type,
          status: this.user.status,
       },{headers:{Authorization: `Bearer ${this.token}`}
        }).then(response=>{
          this.$swal(
              'Success!',
              response.data.message,
              'success'
          );
          $('#addUserModal').hide();
          this.getUserList();
       }).catch(error=>{
            var errorString = '';
            $.each(error.response.data.error, function( key, value) {
                errorString += value + "\n"; 
            }); 
            this.$swal(
              'Error!',
              errorString,
              'error'
            ); 
       });
      },
      getUserDetails(id){
        axios.post('http://localhost:8000/api/user/edit',{ id: id },{headers:{Authorization: `Bearer ${this.token}`}
        }).then(response =>{
          this.id = response.data.data.id;
          this.user.first_name = response.data.data.first_name;
          this.user.last_name = response.data.data.last_name;
          this.user.email = response.data.data.email;
          this.user.user_type = response.data.data.user_type;
          this.user.status = response.data.data.status;

        }).catch(e =>{
          console.log(e)
        });
      },
      update(){
        axios.post('http://localhost:8000/api/user/update',{
            id: this.id,
            first_name: this.user.first_name,
            last_name: this.user.last_name,
            email: this.user.email,
            password: this.user.password,
            user_type: this.user.user_type,
            status: this.user.status,
        },{headers:{Authorization: `Bearer ${this.token}`}
          }).then(response=>{
            this.$swal(
              'Success!',
              response.data.message,
              'success'
            );
            $('#editUserModal').hide();
            this.getUserList();
        }).catch(error=>{
            var errorString = '';
            $.each(error.response.data.error, function( key, value) {
                errorString += value + "\n"; 
            });   
            this.$swal(
              'Error!',
              errorString,
              'error'
            ); 
        });
    },
    deleteUser(id){
    this.$swal({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
      if (result.value) {
        axios.post('http://localhost:8000/api/user/delete',{ id: id },{headers:{Authorization: `Bearer ${this.token}`}})
        .then(response =>{
          this.$swal(
            'Deleted!',
            response.data.message,
            'success'
          );
          this.getUserList();
        }).catch(e=>{
        });
      }
      });
    }
    },
    
}
</script>

<style>
  .modal-backdrop.show{
    opacity: 0;
  }
</style>


