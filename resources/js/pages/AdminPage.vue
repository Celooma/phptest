
<template>

    <NavigationBar/>

    <div class="container">
        <table class="table">
            <thead>
              <tr>

                <th scope="col">Name</th>
                <th scope="col">Start</th>
                <th scope="col">End</th>
                <th scope="col">Status</th>
                <th scope="col" >Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="list in leaveList">

                <td>{{list.user.name}} {{list.id}}</td>
                <td>{{list.start_date}}</td>
                <td>{{list.end_date}}</td>
                <td>{{list.status}}</td>
                <td>
                    <select class="form-select w-50" aria-label="Default select example"  @change="selectStatus($event,list.id)">
                        <option value="Change status" selected>select status:</option>
                        <option value="approved" v-if="list.status !== 'approved'">Approve</option>
                        <option value="declined" v-if="list.status !== 'declined'">Decline</option>
                      </select>
                </td>
              </tr>
        </tbody>
      </table>
    </div>
</template>


<script>
import NavigationBar from '../components/NavigationBar.vue';
export default {
    beforeRouteEnter(to, from, next) {
            if (!localStorage.getItem('token') || !localStorage.getItem('admin') || localStorage.getItem('admin') != 1) {
                return next('login');
            }
            next();
        },
    components: {
            NavigationBar
    },
    data() {
        return {
            leaveList: [],error: '',
    }
  },
  methods: {
    selectStatus(ev,id){

        const status = ev.target.value;
        window.axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`;
        this.$axios.put(`api/leave/${id}`, {status: status}).then(response => {
                 if (response.data.success) {
                    this.leaveList = [...response.data.data];
                    }
            }).catch(function (error) {
                    console.error(error);
        });
    }
  },
   mounted(){
        window.axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`;
        this.$axios.get('api/leave', {}).then(response => {
                 if (response.data.success) {
                    this.leaveList = [...response.data.data];
                    }
            }).catch(function (error) {
                    console.error(error);
            });
    }
}
</script>
