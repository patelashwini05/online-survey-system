<template>
<div>
    <Header/>
    <div class="container-fluid">
        <div class="row">
            <Sidebar/>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <br>
                <form id="submitsurvey">
                <div class="card question-card">
                    <div class="alert alert-danger m-2 text-center" v-if="message">{{ message }}</div>
                    <div class="card-body" v-for="que in question" :key="que.id">
                        <h5>{{ que.title }}</h5>    
                        <div v-if="que.question_type == 'date'" v-for="(input,index) in inputs">
                            <input type="hidden" v-model="que.id"/>
                            <input type="date" class="form-control" v-model="input.answer"/>
                        </div>
                        <div v-if="que.question_type == 'email'" v-for="(input,index) in inputs">
                            <input type="email" class="form-control" v-model="input.answer"/>
                        </div>
                        <div v-if="que.question_type == 'number'">
                            <input type="number" class="form-control"/>
                        </div>
                        <div v-if="que.question_type == 'tel'">
                            <input type="tel" class="form-control" maxlength="10" />
                        </div>
                        <div v-if="que.question_type == 'checkbox'">
                            <div v-for="option in que.question_options" :key="option.id">
                                <input type="checkbox"/>
                                <label>{{ option.option_value }}</label>
                            </div>
                        </div>
                        <div v-if="que.question_type == 'dropdown'">
                            <select class="form-control">
                                <option v-for="option in que.question_options" :key="option.id">{{ option.option_value }}</option>
                            </select>
                        </div>
                        <div v-if="que.question_type == 'longtext'">
                            <textarea class="form-control" placeholder="Write something here..."></textarea>
                        </div>
                        <div v-if="que.question_type == 'shorttext'">
                            <input type="text" class="form-control"/>
                        </div>
                        <div v-if="que.question_type == 'radio'">
                            <div v-for="option in que.question_options" :key="option.id">
                                <input type="radio"/>
                                <label>{{ option.option_value }}</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-submit" @click="submit" v-if="!message">Submit</button>
                    <br>
                </div>
                </form>
            </main>
        </div>
    </div>   
</div>
</template>

<script>
import Header from '../Layout/Header.vue';
import Sidebar from '../Layout/Sidebar.vue';
// import JwPagination from 'jw-vue-pagination';

// import Paginate from 'vuejs-paginate'

export default{
    data(){
        return{
            survey_id: '',
            message: '',
            question: [],
            inputs: [{
                answer: ''
            }]
            // answer:{
            //     date: '',
            //     email: '',
            //     number: '',
            //     contact_number: '',
            //     checkbox: '',
            //     longtext: '',
            //     shorttext: '',
            //     dropdown: '',
            //     radio: ''
            // }
            // currentPage: 1,
            // perPage: 1,
            // rows:9
        }
    },
    components: {
        Header,
        Sidebar,
        // JwPagination
    },
    created(){
        this.survey_id = this.$route.params.id;
        const token = localStorage.getItem('token');
        this.token = token;
        this.getQuestion();
    },
    methods:{
        // rows() {
        //     console.log(this.question);
        //     return this.question.length
        // },
        getQuestion(){
            axios.post('http://localhost:8000/api/question/fetch-question',{survey_id: this.survey_id},{
                headers:{
                    Authorization: `Bearer ${this.token}`
                }
            }).then(response =>{
                // console.log(response.data.data.length);
                this.question = response.data.data;
                if(response.data.data.length == 0){
                    this.message = 'No question found for this survey.'
                }
               
            }).catch(e =>{

            });
        },
        submit(){
            axios.post('http://localhost:8000/api/answer/store',{
                answer: this.inputs
            },{ 
                headers:{
                    Authorization: `Bearer ${this.token}`
                }
            }).then(response =>{

            }).catch(e =>{

            });
        }
    }
}

</script>

<style>
    .question-card{
        width: 50%;
        display: block;
        margin: 0 auto;
    
    }
    .btn-submit{
        display:block;
        margin: 0 auto;
    }
</style>