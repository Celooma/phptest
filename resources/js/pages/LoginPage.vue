
<template>
    <div class="d-flex justify-content-center mt-5">

        <div class="row">
            <h1 class="text-center"> Login </h1>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" placeholder="email@example.com" v-model="email">
              </div>
              <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">password</label>
                <input type="password" class="form-control" id="pass" placeholder="password" v-model="password">
              </div>
              <div >
                <button type="button" class="btn btn-success w-100" @click="login" :disabled="email.trim() == '' || password.trim() == '' ">{{msg}}</button>
              </div>
              <div class="row mt-5">
                <div v-if="error == true"  class="alert alert-danger  fade show" role="alert">
                    Wrong credentials
                   <button type="button" ></button>
               </div>
             </div>

        </div>


    </div>

</template>

<script>

export default {

  data() {
    return {
      email: '',password: '',error:false, msg: 'Login'
    }
  },

  methods: {

    login(){
        this.msg = 'Please wait ...';
        //this.error = false ;
        this.$axios.get('/sanctum/csrf-cookie').then(res =>{
            this.$axios.post('api/login', {
                email: this.email,
                password: this.password

            }).then(response => {
                this.msg = 'Login';
                 if (response.data.success) {

                    localStorage.setItem('token', response.data.token);
                    localStorage.setItem('admin', response.data.isAdmin);
                    localStorage.setItem('name', response.data.name);

                    if(response.data.isAdmin == 1){
                       this.$router.push('/admin')
                    }
                    else this.$router.push('/apply')
                } else {
                    this.error = true ;
                    }
            }).catch(function (error) {
                this.msg = 'Login';
                this.error = true ;
            });
        })
    }
  }
}
</script>
