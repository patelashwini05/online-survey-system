<template>
<div class="login text-center">
    <main class="form-signin">
    <form>
        <img class="mb-4" src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
    
        <div class="alert alert-danger" v-if="error_message">{{error_message}}</div>
        <div class="form-floating">
          <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" v-model="email">
          <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating">
          <input type="password" class="form-control" id="floatingPassword" placeholder="Password" v-model="password">
          <label for="floatingPassword">Password</label>
        </div>
    
        <div class="checkbox mb-3">
          <label>
            <input type="checkbox" v-model="remember_me" value="remember_me"/> Remember me
          </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" @click="login">Sign in</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
    </form>
    </main>
</div>
</template>

<script>
import $ from 'jquery';
    export default{
      data(){
        return {
          email: '',
          password: '',
          remember_me: false,
          error_message: ''
        }
      },
      methods:{
        login(){
          axios.post('http://localhost:8000/api/login',{
            email: this.email,
            password: this.password,
            remember_me: this.remember_me
          })
          .then(response=>{
            console.log(response.data.success);
            localStorage.setItem('token',response.data.token);
            localStorage.setItem('user',JSON.stringify(response.data.user));
            this.$router.push({path:'/dashboard'});
          }).catch(error=>{
            if(error.response.status == 401){
              this.error_message = error.response.data.message;
            }
            else if(error.response.status == 422){
              var errorString = '';
              $.each(error.response.data.errors, function( key, value) {
                  errorString += value + "\n"; 
              });
              this.error_message = errorString;
            }
            
          });
        }
      }
    }
</script>

<style>
body{
    background-color: #f5f5f5; 
}

.login {
  padding-top: 40px;
  padding-bottom: 40px;
}

.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: auto;
}

.form-signin .checkbox {
  font-weight: 400;
}

.form-signin .form-floating:focus-within {
  z-index: 2;
}

.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

.bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
}

@media (min-width: 768px) {
    .bd-placeholder-img-lg {
        font-size: 3.5rem;
    }
}
</style>