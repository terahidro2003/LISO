<template>
<div>
  <div class="page-header mb-4">
      <div class="description">
        <h3>Atnaujinti grupe</h3>
        <h1>{{name}}</h1>
      </div>
      <div class="ml-5 stats">
         <div class="actions">
          <router-link to="/groups" class="btn btn-danger">
            <span data-feather="x-circle" class="icon"></span>
            <span>Atsaukti</span>
          </router-link>
        </div>
      </div>
    </div>

    <div class="page-content justify-content-center">
      <div class="card card-big">
      <div class="card-body">
        <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control input-search" style="font-size: 1.8em; border: none;font-weight: bolder; padding: 2rem .7rem;padding-left:0;" placeholder="Grupes pavadinimas" v-model="name">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputBname">Treneris</label>
                                <input type="text" class="form-control" id="inputBname" placeholder="Vardenis Pavardenis" v-model="leader">
                            </div>
                            <div class="form-group col-md-10">
                                <label for="inputBname">Lygis</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                      <input type="radio"  value="100" class="selectgroup-input">
                                      <span class="selectgroup-button">Pradinis</span>
                                    </label>
                                    <label class="selectgroup-item">
                                      <input type="radio"  value="100" class="selectgroup-input">
                                      <span class="selectgroup-button">Vidutinis</span>
                                    </label>
                                    <label class="selectgroup-item">
                                      <input type="radio" value="100" class="selectgroup-input">
                                      <span class="selectgroup-button">Pazengusiuju</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="inputBname">Aprasymas</label>
                                <textarea type="text" class="form-control" id="inputBname" placeholder="----APRASYMA RASYKITE CIA----" v-model="description"></textarea>
                            </div>
                        </div>
                        <a href="#" class="btn btn-primary" v-on:click="groupMake">Sukurti nauja grupe</a>
        </div>
      </div>
    </div>

      <div class="card big">
        <div class="card-header flex-s">
          <h2 class="vertical-align">Nariai</h2>
        </div>

        <div class="card-body">
            <div class="alert alert-warning">
              <h4>Siai grupei siuo metu nera priskirta nariu</h4>
            </div>
            <table class="table card-table table-vcenter text-nowrap datatable dataTable no-footer" v-if="API_results.members != null || API_results.members != ''">
                <thead>
                    <tr>
                        <th>Vardas</th>
                        <th>Pavarde</th>
                        <th>Miestas</th>
                        <th>Gimimo data</th>
                        <th>Telefono numeris</th>
                        <th>Grupe</th>
                        <th>Veiksmai</th>
                    </tr>
                </thead>
                <tbody>
                        <tr v-for="result in API_results.members">
                            <td> {{result.firstName}} </td>
                            <td> {{result.lastName}} </td>
                            <td> {{result.city}} </td>
                            <td> {{result.birthDate}} </td>
                            <td> {{result.primaryPhone}} </td>
                            <td>
                              {{result.groupName}}
                              <label class="bg-label bg-label-warning" v-if="result.groupName == null || result.groupName == ''">Nepriskirtas(-a)</label>
                            </td>
                            <td>
                                <span href="" class="link" @click="showEditDialog(result.id)">Redaguoti</span>
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
        name: null,
        leader: null,
        description: null,
        API_results: null,
      }
    },
    mounted(){
      axios.get('/api/groups/'+ this.$route.params.id, {

      }).then(response => {
        this.API_results = response.data;
        this.name = response.data.group.groupName;
        this.leader = response.data.group.leader;
        this.description = response.data.group.description;
      });
    },
    methods: {
      //console.log('mounted');

      groupMake: function(){ axios.post('/api/groups/update/' + this.$route.params.id, { groupName:
      this.name, leader: this.leader, description: this.description,
    }).then(response => { if (response.data.status == 'OK') { console.log('SUCCESS'); this.$router.push('/groups');
      }else{ console.log(response.data); } }); } } } </script>

<style>
</style>
