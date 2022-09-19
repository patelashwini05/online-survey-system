<template>
<div>
<Header/>
<div class="container-fluid">
    <div class="row">
        <Sidebar/>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <br>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addQuestionModal">Add New Question</button>
            <div class="card mt-2 mb-2">
                <div class="row">
                    <div class="col-lg-12" >
                        <div class="question-card m-4 p-2" v-for="question in questions" :key="question.id">
                            <h5>{{ question.title }}</h5>
                            <span class="float-end" style="margin-top:-35px">
                                <button class="btn btn-sm btn-success" :value="question.id" data-bs-toggle="modal" data-bs-target="#editQuestionModal" @click="getQuestionDetails(question.id)">Edit</button>
                                <button class="btn btn-sm btn-danger" :value="question.id" @click="deleteQuestion(question.id)">Delete</button>
                            </span>
                            <div v-if="question.question_type == 'date'">
                                <input type="date" class="form-control"/>
                            </div>
                            <div v-if="question.question_type == 'email'">
                                <input type="email" class="form-control" placeholder="email"/>
                            </div>
                            <div v-if="question.question_type == 'number'">
                                <input type="number" class="form-control" :placeholder="question.title"/>
                            </div>
                            <div v-if="question.question_type == 'tel'">
                                <input type="tel" class="form-control" placeholder="contact number" mexlength="10"/>
                            </div>
                            <div v-if="question.question_type == 'checkbox'">
                                <div v-for="option in question.question_options" :key="option.id">
                                    <input type="checkbox"/>
                                    <label>{{ option.option_value }}</label>
                                </div>
                            </div>
                            <div v-if="question.question_type == 'dropdown'">
                                <select class="form-control" >
                                    <option v-for="option in question.question_options" :key="option.id">{{ option.option_value }}</option>
                                </select>
                            </div>
                            <div v-if="question.question_type == 'longtext'">
                                <textarea type="text" class="form-control" placeholder="Write something here.."></textarea>
                            </div>
                            <div v-if="question.question_type == 'shorttext'">
                                <input type="text" class="form-control" placeholder="fullname"/>
                            </div>  
                            <div v-if="question.question_type == 'radio'">
                                <div v-for="option in question.question_options" :key="option.id">
                                    <input type="radio"/>
                                    <label>{{ option.option_value }}</label>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Add Question Modal -->
<div class="modal fade" id="addQuestionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Question</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="addquestionform">
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-6">
                    <label>Title</label>
                    <input type="text" class="form-control" placeholder="Enter question title" v-model="question.title"/>
                    <br>
                    <label>Description</label>
                    <textarea class="form-control" type="text" placeholder="Enter question decription" v-model="question.description"></textarea>
                    <br>
                    <label>Question Type</label>
                    <select class="form-control" v-model="question.question_type">
                        <option value="">Select Question Type</option>
                        <option value="date">Date</option>
                        <option value="email">Email</option>
                        <option value="number">Number</option>
                        <option value="tel">Contact Number</option>
                        <option value="rating">Rating</option>
                        <option value="checkbox">Checkbox</option>
                        <option value="dropdown">Dropdown</option>
                        <option value="longtext">Long Text</option>
                        <option value="shorttext">Short Text</option>
                        <option value="radio">Radio Button</option> 
                    </select>
                    <br>
                    <label>Status</label>
                    <br>
                    <input type="radio" value="published" v-model="question.status"/>
                    <label for="published">Published</label>
                    <input type="radio" value="unpublished" v-model="question.status"/>
                    <label for="unpublished">Unpublished</label>
                </div>
                <div class="col-lg-6">
                    <div v-if="question.question_type == 'date'">
                        <input type="date" class="form-control"/>
                    </div>
                    <div v-if="question.question_type == 'email'">
                        <input type="email" class="form-control" placeholder="Enter your valid email"/>
                    </div>
                    <div v-if="question.question_type == 'number'">
                        <input type="number" class="form-control"/>
                    </div>
                    <div v-if="question.question_type == 'tel'">
                        <input type="tel" class="form-control" placeholder="Enter your contact number" maxlength="10"/> 
                    </div>
                    <div v-if="question.question_type == 'rating'">
                        
                    </div>
                    <div v-if="question.question_type == 'checkbox'">
                        <div v-for="(input,index) in inputs">
                            <input type="checkbox" class="customCheckBox"/>
                            <input type="text" class="form-control" v-model="input.option"/>
                            <button class="btn btn-sm btn-danger" @click="deleteCheckBox(index)">Delete</button>
                        </div>
                        <br>
                        <button class="btn btn-primary btn-sm" @click="addCheckBox">Add</button>
                    </div>
                    <div v-if="question.question_type == 'dropdown'">
                        <div v-for="(input,index) in inputs">
                            <input type="text" class="form-control" v-model="input.option"/>
                            <button class="btn btn-sm btn-danger" @click="deleteCheckBox(index)">Delete</button>
                        </div>
                        <br>
                        <button class="btn btn-primary btn-sm" @click="addCheckBox">Add</button>
                    </div>
                    <div v-if="question.question_type == 'longtext'">
                        <textarea type="text" class="form-control" placeholder="Write something here..."></textarea>
                    </div>
                    <div v-if="question.question_type == 'shorttext'">
                        <input type="text" class="form-control"/>
                    </div>
                    <div v-if="question.question_type == 'radio'">
                        <div v-for="(input,index) in inputs">
                            <input type="radio"/>
                            <input type="text" class="form-control" v-model="input.option"/>
                            <button class="btn btn-sm btn-danger" @click="deleteCheckBox(index)">Delete</button>
                        </div>
                        <br>
                        <button class="btn btn-primary btn-sm" @click="addCheckBox">Add</button>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" @click="addQuestion">Save</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
        </form>
      </div>
    </div>
</div>

<!-- Edit Question Modal -->
<div class="modal fade" id="editQuestionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Question</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="editquestionform">
        <input type="hidden" v-model="question_id"/>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-6">
                    <label>Title</label>
                    <input type="text" class="form-control" placeholder="Enter question title" v-model="question.title"/>
                    <br>
                    <label>Description</label>
                    <textarea class="form-control" type="text" placeholder="Enter question decription" v-model="question.description"></textarea>
                    <br>
                    <label>Question Type</label>
                    <select class="form-control" v-model="question.question_type">
                        <option value="">Select Question Type</option>
                        <option value="date">Date</option>
                        <option value="email">Email</option>
                        <option value="number">Number</option>
                        <option value="tel">Contact Number</option>
                        <option value="rating">Rating</option>
                        <option value="checkbox">Checkbox</option>
                        <option value="dropdown">Dropdown</option>
                        <option value="longtext">Long Text</option>
                        <option value="shorttext">Short Text</option>
                        <option value="radio">Radio Button</option> 
                    </select>
                    <br>
                    <label>Status</label>
                    <br>
                    <input type="radio" value="published" v-model="question.status"/>
                    <label for="published">Published</label>
                    <input type="radio" value="unpublished" v-model="question.status"/>
                    <label for="unpublished">Unpublished</label>
                </div>
                <div class="col-lg-6">
                    <div v-if="question.question_type == 'date'">
                        <input type="date" class="form-control"/>
                    </div>
                    <div v-if="question.question_type == 'email'">
                        <input type="email" class="form-control" placeholder="Enter your valid email"/>
                    </div>
                    <div v-if="question.question_type == 'number'">
                        <input type="number" class="form-control"/>
                    </div>
                    <div v-if="question.question_type == 'tel'">
                        <input type="tel" class="form-control" placeholder="Enter your contact number" maxlength="10"/> 
                    </div>
                    <div v-if="question.question_type == 'rating'">
                        
                    </div>
                    <div v-if="question.question_type == 'checkbox'">
                        <div v-for="(input,index) in inputs">
                            <input type="checkbox" class="customCheckBox"/>
                            <input type="text" class="form-control" v-model="input.option"/>
                            <button class="btn btn-sm btn-danger" @click="deleteCheckBox(index)">Delete</button>
                        </div>
                        <br>
                        <button class="btn btn-primary btn-sm" @click="addCheckBox">Add</button>
                    </div>
                    <div v-if="question.question_type == 'dropdown'">
                        <div v-for="(input,index) in inputs">
                            <input type="text" class="form-control" v-model="input.option"/>
                            <button class="btn btn-sm btn-danger" @click="deleteCheckBox(index)">Delete</button>
                        </div>
                        <br>
                        <button class="btn btn-primary btn-sm" @click="addCheckBox">Add</button>
                    </div>
                    <div v-if="question.question_type == 'longtext'">
                        <textarea type="text" class="form-control" placeholder="Write something here..."></textarea>
                    </div>
                    <div v-if="question.question_type == 'shorttext'">
                        <input type="text" class="form-control"/>
                    </div>
                    <div v-if="question.question_type == 'radio'">
                        <div v-for="(input,index) in inputs">
                            <input type="radio"/>
                            <input type="text" class="form-control" v-model="input.option"/>
                            <button class="btn btn-sm btn-danger" @click="deleteCheckBox(index)">Delete</button>
                        </div>
                        <br>
                        <button class="btn btn-primary btn-sm" @click="addCheckBox">Add</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" @click="updateQuestion">Update</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
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
import $ from 'jquery';

export default{
    components: {
        Header,
        Sidebar
    },
    data(){
        return{
            selected: '',
            inputs: [],
            question: {
                title: '',
                description: '',
                question_type: '',
                status: ''
            },
            survey_id: '',
            question_id: '',
            questions: []
        }
    },
    created(){
        this.survey_id = this.$route.params.id;
        const token = localStorage.getItem('token');
        this.token = token;
        this.getQuestions();
    },
    methods:{
        addCheckBox(){
            this.inputs.push({
                option: '',
            })
        },
        deleteCheckBox(index){
            this.inputs.splice(index,1);
        },
        getQuestions(){
            axios.get('http://localhost:8000/api/question/list',{
                headers:{
                    Authorization: `Bearer ${this.token}`
                }
            })
            .then(response =>{
                this.questions = response.data.data;
            }).catch(e =>{
                console.log(e)
            });
        },
        addQuestion(){
            axios.post('http://localhost:8000/api/question/add',{
                survey_id : this.survey_id,
                title : this.question.title,
                description: this.question.description,
                question_type: this.question.question_type,
                question_options : this.inputs,
                status: this.question.status
            },{
                headers:{
                    Authorization: `Bearer ${this.token}`
                }
            }).then(response =>{
                this.$swal(
                    'Success!',
                    response.data.message,
                    'success'
                );
                $('#addQuestionModal').hide();
                this.getQuestions();
            }).catch(e=>{

            });
        },
        getQuestionDetails(id){
            axios.post('http://localhost:8000/api/question/edit',{ id: id },{headers:{Authorization: `Bearer ${this.token}`}
            }).then(response =>{
                this.question_id = response.data.data.id;
                this.question.title = response.data.data.title;
                this.question.description = response.data.data.description;
                this.question.question_type = response.data.data.question_type;
                this.question.status = response.data.data.status;

                // console.log(response.data.data.question_options);
                if(response.data.data.question_options){
                    $.each(response.data.data.question_options, function( key, value) {
                        this.inputs = response.data.data.question_options[key].option_value;
                        console.log(this.inputs);
                    }); 
                }
            
                // if(response.data.data.question_options){
                //     alert('hi');
                //     this.inputs = response.data.data.question_options[0].option_value;
                //     console.log(this.inputs);
                // }
            }).catch(e =>{
            console.log(e)
            });
        },
        updateQuestion(){
            axios.post('http://localhost:8000/api/question/update',{
                id: this.question_id,
                survey_id : this.survey_id,
                title : this.question.title,
                description: this.question.description,
                question_type: this.question.question_type,
                question_options : this.inputs,
                status: this.question.status
            },{
                headers:{
                    Authorization: `Bearer ${this.token}`
                }
            }).then(response =>{
                this.$swal(
                    'Success!',
                    response.data.message,
                    'success'
                );
                $('#editQuestionModal').hide();
                this.getQuestions();
            }).catch(e=>{

            });
        },
        deleteQuestion(id){
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
                axios.post('http://localhost:8000/api/question/delete',{ id: id },{headers:{Authorization: `Bearer ${this.token}`}})
                .then(response =>{
                this.$swal(
                    'Deleted!',
                    response.data.message,
                    'success'
                );
                this.getQuestions();
                }).catch(e=>{
                });
            }
        });
        }
    }
}
</script>

<style>
    /* .customCheckBox{
        height: 25px;
        width: 25px;
        border-radius: none !important;
    }, */
    .question-card{
        border: 1px solid #ccc !important;
        border-radius: 5px !important;
    }
    .modal-backdrop.show{
      opacity: 0;
    }
</style>