<template>
  <div>
  <div class="page-header mb-4">
      <div class="description">
        <h3>Nariai</h3>
        <h1>Visi nariai</h1>
      </div>
      <div class="ml-5 stats">
        <div class="stat mr-5">
          <span class="mt-1 status status-ok"></span>
          <h1 class="number mt-3 ml-2">{{membersCount}}</h1>
          <div class="txt mt-2 ml-2">
            <h2>Iš viso narių</h2>
            <h3>registruota sistemoje</h3>
          </div>
        </div>

        <div class="stat">
          <div class="actions" style="float: right;">
            <router-link to="/members/add" class="btn btn-primary btn-small">
              <span data-feather="x-circle" class="icon"></span>
              <span>Prideti nauja nari</span>
            </router-link>
          </div>
        </div>
      </div>
    </div>

    <div class="mt-5 mb-5 filter">
        <div class="justify-content-center">
          <div class="row">
            <div class="col">
              <label class="label">Grupe</label>
              <select v-model="filterGroup" class="form-control white" name="group" @change="filterTable('group', $event)">
                <option value="0">Visa studija</option>
                <optgroup v-for="group in groups">
                  <option :value="group.id">{{group.groupName}}</option>
                </optgroup>

              </select>
            </div>

             <div class="col">
              <label class="label">Miestas</label>
              <select v-model="filterCity" class="form-control white" name="group" @change="filterTable('city', $event)">
                  <option value="klaipeda">Klaipeda</option>
                  <option value="vilnius">Vilnius</option>
                  <option value="0">Visi</option>
              </select>
            </div>
          </div>
        </div>
    </div>
    <div class="page-content justify-content-center">
            <div class="card big">
                <div class="card-header flex-s">
                  <h2 class="vertical-align">Nariai</h2>
                </div>

                <div class="card-body">
                    <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                        <thead>
                            <tr>
                                <th>Vardas, pavarde</th>
                                <th>Miestas</th>
                                <th>Gimimo data</th>
                                <th>Telefono numeris</th>
                                <th>Grupe</th>
                                <th>Veiksmai</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr v-for="result in API_results">
                                    <td>
                                      <div>{{result.firstName}} {{result.lastName}}</div>
                                      <div class="small text-muted">Narys nuo {{result.created_at}}</div>
                                    </td>
                                    <td> {{result.city}} </td>
                                    <td> {{result.birthDate}} </td>
                                    <td> {{result.primaryPhone}} </td>
                                    <td>
                                      <label class="bg-label bg-label-warning" v-if="result.groupName == null || result.groupName == ''" data-toggle="dropdown">Nepriskirtas(-a)</label>
                                      <label class="bg-label bg-label-main" v-if="result.groupName != null || result.groupName != ''" data-toggle="dropdown">{{result.groupName}}</label>
                                      <div class="dropdown-menu">
                                        <div v-for="group in groups">
                                          <a class="dropdown-item" href="#" @click="changeMembersGroup(group.id, result.id)">{{group.groupName}}</a>
                                        </div>

                                      </div>
                                    </td>
                                    <td>
                                        <span href="" class="link" @click="showEditDialog(result.id)">Redaguoti</span>
                                        <span href="" class="link" @click="deleteMember(result.id)">Istrinti</span>
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
  </div>
</template>

<script>

  export default {
    data(){
      return{
        API_results: [],
        groups: [],
        membersCount: null,
        operationState: null,
        filterCity: 0,
        filterGroup: 0,
      }
    },
    methods: {
      /*
      Following bugs detected:
      1. All studio option is not working correctly
      2. Filters can't work together
      */
      showEditDialog(id){
        this.$router.push('/members/edit/'+id);
      },

      changeMembersGroup(id, member){
        axios.post('/api/members/changeGroup/' + member, {
          groupID: id,
        }).then(response => {
          if(response.data.status == 'OK'){
            this.operationState = 1;
            axios.get('/api/members').then(response => {
              this.API_results = response.data;
              this.membersCount = response.data.length;
            });
          }
        });
      },

      filterTable(){
        var config = {
            group: this.filterGroup,
            city: this.filterCity
        }

        var reqURL = "api/members/filter/";
         axios.post(reqURL, config).then(response => {
           this.API_results = response.data;
         });

      },
      deleteMember(id) {
        swal({
          title: "Please confirm DANCER deletion",
          text: "You want to delete a dancer!",
          icon: "warning",
          buttons: true,
          closeModal: true,
          dangerMode: true
        }).then(value => {
          if(value)
          axios.post('/members/delete', {
            'id': id
          }).then(response => {
            if(response.status == 200) {
              this.filterTable();
              this.updater();
              swal({title: "Deleted", icon: "success"});
              setTimeout(()=> {swal.close()}, 1000);
            }
            else swal("Error!","" ,"error");
          });
        });
      },
      updater() {
        axios.get('/api/members').then(response => {
          this.API_results = response.data;
          this.membersCount = response.data.length;
        });
        axios.get('/api/groups').then(response => {
          this.groups = response.data;
        });
      }
    },
    mounted() {
      this.updater();
    }
  }
</script>

<style scoped>
span {
  cursor: pointer;
}
</style>
