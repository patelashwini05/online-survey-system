<template>
<div>
    <Header/>
    <div class="container-fluid">
        <div class="row">
            <Sidebar/>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <br>
                <div class="card">
                    <div class="card-header text-center">
                        Survey List
                    </div>
                    <div class="card-body" v-for="survey in surveys" :key="survey.id">
                        <router-link :to="{name: 'TakeSurvey', params: {id : survey.id }}">{{ survey.title }}</router-link>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
</template>

<script>
import Header from '../Layout/Header.vue';
import Sidebar from '../Layout/Sidebar.vue';

export default{
    components: {
        Header,
        Sidebar
    },
    data(){
        return{
            surveys: []
        }
    },
    created(){
        const token = localStorage.getItem('token');
        this.token = token;
        this.getSurveys();
    },
    methods:{
        getSurveys(){
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
        }
    }
}
</script>