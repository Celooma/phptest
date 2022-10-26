<template>
    <div>
        <div class="float-end mt-2 mb-5"><span class="me-3">Hi {{name}} </span> <button type="button" class="btn btn-success me-5 " @click="logout">Logout</button></div>
    </div>
</template>
<script>

export default {

    data() {
        return {
            name: localStorage.getItem('name')
        }
   },

  methods: {
    logout(){
        //localStorage.clear();
        window.axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`;
        this.$axios.post(`api/logout`, {}).then(response => {
                console.log(response)
            }).catch(function (error) {
                    console.error(error);
        });
        localStorage.clear();
        this.$router.push('login');
    }
  }
}
</script>
