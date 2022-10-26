<template>

    <div class="container ">
        <div class="row">
            <NavigationBar/>
            <div v-if="success == 'success' " class="alert alert-success alert-dismissible fade show" role="alert">
                 Success!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <div v-if="success == 'error' " class="alert alert-danger alert-dismissible fade show" role="alert">
                Something went wrong
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           </div>
        </div>
        <h1 class="text-center mt-5"> Apply for leave</h1>
        <div class="d-flex justify-content-center ">

            <div class="row mt-5">
                <div class="col-md-6">
                    <label>From </label>
                    <input type="date" class="form-control" v-model="startDate">
                </div>
                <div class="col-md-6">
                    <label>To </label>
                    <input type="date" class="form-control" v-model="endDate">
                </div>
                <div class="mt-5">
                    <button type="button" class="btn btn-success w-100" @click="apply" :disabled="!startDate || !endDate ">Submit</button>
                </div>

            </div>

        </div>
    </div>
</template>

<script>
import NavigationBar from '../components/NavigationBar.vue';
export default {
    beforeRouteEnter(to, from, next) {
            if (!localStorage.getItem('token')) {
                return next('login');
            }
            next();
    },
  data() {
    return {
        startDate: '',endDate: '', success: ''
    }
  },
  components: {
        NavigationBar
    },

  methods: {

    apply(){
        this.success = '';
        console.log(this.startDate)
        window.axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`;
            this.$axios.post('api/leave', {
                startDate: this.startDate,
                endDate: this.endDate

            }).then(response => {
                 if (response.data.success) {
                        this.success = 'success';
                    } else {
                        console.log(response)
                        this.success = 'error' ;
                    }
            }).catch(function (error) {
                this.success = 'error' ;
            });
        // })
    }
  }
}
</script>
