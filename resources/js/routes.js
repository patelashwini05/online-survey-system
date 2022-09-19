import Vue from 'vue';
import VueRouter from 'vue-router';
// import Login from './components/Login.vue';
// import Dashboard from './components/Dashboard.vue';
// import UserList from './components/User/List.vue';


Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        name: 'Login',
        component: () =>  import("./components/Login.vue")
    },
    {
        path: '/dashboard',
        name: 'Dashboard',
        component: () =>  import("./components/Dashboard.vue")
    },
    {
        path: '/user-list',
        name: 'UserList',
        component: () =>  import("./components/User/List.vue")
    },
    {
        path: '/survey-list',
        name: 'SurveyList',
        component: () =>  import("./components/Survey/List.vue")
    },
    {
        path: '/view-survey/:id',
        name: 'ViewSurvey',
        component: () =>  import("./components/Survey/View.vue")
    },
    {
        path: '/surveys',
        name: 'Surveys',
        component: () =>  import("./components/Staff/Surveys.vue")
    },
    {
        path: '/take-survey/:id',
        name: 'TakeSurvey',
        component: () =>  import("./components/Staff/TakeSurvey.vue")
    },
];

const router = new VueRouter({
    mode: 'hash',
    routes
});

export default router;
