<template>
<div>
  <div class="page-header mb-4">
      <div class="description">
        <h3>Atnaujinti grupę</h3>
        <h1>{{name}}</h1>
      </div>
      <div class="ml-5 stats">
         <div class="actions">
          <router-link to="/groups" class="btn btn-danger">
            <span data-feather="x-circle" class="icon"></span>
            <span>Atšaukti</span>
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
                                      <input type="radio"  value="1" class="selectgroup-input" v-model="level"/>
                                      <span class="selectgroup-button">Pradinis</span>
                                    </label>
                                    <label class="selectgroup-item">
                                      <input type="radio"  value="2" class="selectgroup-input" v-model="level">
                                      <span class="selectgroup-button">Vidutinis</span>
                                    </label>
                                    <label class="selectgroup-item">
                                      <input type="radio" value="3" v-model="level" class="selectgroup-input">
                                      <span class="selectgroup-button">Pažengusiųjų</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="inputBname">Aprašymas</label>
                                <textarea type="text" class="form-control" id="inputBname" placeholder="----APRASYMA RASYKITE CIA----" v-model="description"></textarea>
                            </div>
                        </div>
                        <a href="#" class="btn btn-primary" v-on:click="groupMake">Sukurti naują grupę</a>
        </div>
      </div>
    </div>

      <div class="card big">
        <div class="card-header flex-s">
          <h2 class="vertical-align">Nariai</h2>
        </div>

        <div class="card-body">
            <div class="alert alert-warning" v-if="members == null || members.length == 0">
              <h4>Šiai grupei šiuo metu nėra priskirta narių</h4>
            </div>
            <table class="table card-table table-vcenter text-nowrap datatable dataTable no-footer" v-if="members != null || members != ''">
                <thead>
                    <tr>
                        <th>Vardas</th>
                        <th>Pavardė</th>
                        <th>Miestas</th>
                        <th>Gimimo data</th>
                        <th>Telefono numeris</th>
                        <th>Grupė</th>
                        <th>Veiksmai</th>
                    </tr>
                </thead>
                <tbody>
                        <tr v-for="result in members">
                            <td> {{result.firstName}} </td>
                            <td> {{result.lastName}} </td>
                            <td> {{result.city}} </td>
                            <td> {{result.birthDate}} </td>
                            <td> {{result.primaryPhone}} </td>
                            <td>
                              {{result.groupName}}
                              <label class="bg-label bg-label-main">{{name}}</label>
                            </td>
                            <td>
                                <router-link :to="{ name: 'edit', params: { id: result.id}}"><span class="link">Redaguoti</span></router-link>
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
        members: null,
      }
    },
    mounted(){
      axios.get('/api/groups/'+ this.$route.params.id, {

      }).then(response => {
        this.API_results = response.data;
        this.members = response.data.members;
        this.name = response.data.group.groupName;
        this.level = response.data.group.level;
        this.leader = response.data.group.leader;
        this.description = response.data.group.description;
        // console.log(response.data.members);
      });
    },
    methods: {
      //console.log('mounted');

      groupMake: function(){ axios.post('/api/groups/update/' + this.$route.params.id, { groupName:
      this.name, leader: this.leader, description: this.description, level: this.level,
    }).then(response => { if (response.data.status == 'OK') { console.log('SUCCESS'); this.$router.push('/groups');
      }else{ console.log(response.data); } }); } } } </script>

<style>
</style>
