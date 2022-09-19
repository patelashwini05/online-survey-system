<template>
<div>
<Header/>
<div class="container-fluid">
    <div class="row">
        <Sidebar/>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <br>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addSurveyModal">Add Survey</button>
              <h2 class="text-center">Survey List</h2>
              <div class="table-responsive">
                <table class="table table-striped table-sm">
                  <thead>
                    <tr>
                      <th scope="col">Title</th>
                      <th scope="col">Description</th>
                      <th scope="col">Status</th>
                      <th scope="col">Created At</th>
                      <th scope="col">Updated At</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="survey in surveys" :key="survey.id">
                      <td>{{ survey.title }}</td>
                      <td>{{ survey.description }}</td>
                      <td>{{ survey.status }}</td>
                      <td>{{ moment(survey.created_at).format("DD-MM-YYYY") }}</td>
                      <td>{{ moment(survey.updated_at).format("DD-MM-YYYY") }}</td>
                      <td>
                          <router-link class="btn btn-primary btn-sm" :to= "{name: 'ViewSurvey', params: {id : survey.id }}">View</router-link>
                          <button class="btn btn-success btn-sm" :value="survey.id" data-bs-toggle="modal" data-bs-target="#editSurveyModal" @click="getSurveyDetails(survey.id)">Edit</button>
                          <button class="btn btn-danger btn-sm" :value="survey.id" @click="deleteSurvey(survey.id)">Delete</button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
        </main>
    </div>
</div>

<!-- Add Survey Modal -->
<div class="modal fade" id="addSurveyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-uppercase" id="exampleModalLabel">ADD SURVEY</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="adduserform">
        <div class="modal-body">
          <div class="row">
              <div class="col-lg-4">
                  <label>Title</label>
              </div>
              <div class="col-lg-8">
                  <input type="text" class="form-control" placeholder="Enter your survey title" v-model="survey.title"/>
                  <br>
              </div>
              <div class="col-lg-4">
                <label>Description</label>
              </div>
              <div class="col-lg-8">
                <textarea type="text" class="form-control" placeholder="Enter your survey brief description" v-model="survey.description"></textarea>
                <br>
              </div>
              <div class="col-lg-4">
                <label>Status</label>
              </div>
              <div class="col-lg-8">
                <input type="radio" value="published" v-model="survey.status"/>
                <label for="published">Published</label>
                <input type="radio" value="unpublished" v-model="survey.status"/>
                <label for="unpublished">Unpublished</label>
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

<!-- Edit Survey Modal -->
<div class="modal fade" id="editSurveyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-uppercase" id="exampleModalLabel">Edit SURVEY</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="edituserform">
        <div class="modal-body">
          <div class="row">
              <div class="col-lg-4">
                  <label>Title</label>
              </div>
              <div class="col-lg-8">
                  <input type="text" class="form-control" placeholder="Enter your survey title" v-model="survey.title"/>
                  <br>
              </div>
              <div class="col-lg-4">
                <label>Description</label>
              </div>
              <div class="col-lg-8">
                <textarea type="text" class="form-control" placeholder="Enter your survey brief description" v-model="survey.description"></textarea>
                <br>
              </div>
              <div class="col-lg-4">
                <label>Status</label>
              </div>
              <div class="col-lg-8">
                <input type="radio" value="published" v-model="survey.status"/>
                <label for="published">Published</label>
                <input type="radio" value="unpublished" v-model="survey.status"/>
                <label for="unpublished">Unpublished</label>
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
            surveys:[],
            moment: moment,
            survey:{
                title: '',
                description: '',
                status: ''
            }
        }
    },
    created(){
        const token = localStorage.getItem('token');
        this.token = token;
        this.getSurveyList();
    },
    methods:{
    getSurveyList(){
        axios.get('http://localhost:8000/api/survey/list',{
            headers:{
                Authorization: `Bearer ${this.token}`
            }
        })
        .then(response=>{
            this.surveys = response.data.data;
        }).catch(e=>{
            console.log(e);
        });
    },
    submit(){
       axios.post('http://localhost:8000/api/survey/add',{
          title: this.survey.title,
          description: this.survey.description,
          status: this.survey.status,
       },{headers:{Authorization: `Bearer ${this.token}`}
        }).then(response=>{
          this.$swal(
              'Success!',
              response.data.message,
              'success'
          );
          $('#addSurveyModal').hide();
          this.getSurveyList();
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
    getSurveyDetails(id){
        axios.post('http://localhost:8000/api/survey/edit',{ id: id },{headers:{Authorization: `Bearer ${this.token}`}
        }).then(response =>{
          this.id = response.data.data.id;
          this.survey.title = response.data.data.title;
          this.survey.description = response.data.data.description;
          this.survey.status = response.data.data.status;
        }).catch(e =>{
          console.log(e)
        });
    },
    update(){
        axios.post('http://localhost:8000/api/survey/update',{
            id: this.id,
            title: this.survey.title,
            description: this.survey.description,
            status: this.survey.status,
        },{headers:{Authorization: `Bearer ${this.token}`}
          }).then(response=>{
            this.$swal(
              'Success!',
              response.data.message,
              'success'
            );
            $('#editSurveyModal').hide();
            this.getSurveyList();
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
    deleteSurvey(id){
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
                axios.post('http://localhost:8000/api/survey/delete',{ id: id },{headers:{Authorization: `Bearer ${this.token}`}})
                .then(response =>{
                this.$swal(
                    'Deleted!',
                    response.data.message,
                    'success'
                );
                this.getSurveyList();
                }).catch(e=>{
                });
            }
        });
    }
    }
    
}
</script>

<style>
    .modal-backdrop.show{
      opacity: 0;
    }
</style>
  