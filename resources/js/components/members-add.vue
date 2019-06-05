<template>
<div>
  <div class="page-header mb-4">
      <div class="description">
        <h3>Nariai</h3>
        <h1>Naujo nario anketa</h1>
      </div>
      <div class="ml-5 stats">
         <div class="actions">
          <router-link to="/members/add" class="btn btn-danger">
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
                                <input type="text" class="form-control input-search" style="font-size: 1.8em; border: none;font-weight: bolder; padding: 2rem .7rem;padding-left:0;" placeholder="Vardas ir Pavarde" v-model="fullName">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputBname">Telefono numeris</label>
                                <input type="text" class="form-control" id="inputBname" placeholder="+3706xxxxx" v-model="primaryPhone">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputBname">Antras telefono numeris</label>
                                <input type="text" class="form-control" id="inputBname" placeholder="+3706xxxxx" v-model="secondaryPhone">
                            </div>
                            <div class="form-group col-md-8">
                                <label for="inputBname">El. pasto adresas</label>
                                <input type="text" class="form-control" id="inputBname" placeholder="hello@sfinx.lt" v-model="email">
                            </div>
                            <div class="form-group col-md-5">
                                <label for="inputBname">Facebook vartotojas</label>
                                <input type="text" class="form-control" id="inputBname" placeholder="hello@sfinx.lt" v-model="facebook">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputBname">Instagram vartotojas</label>
                                <input type="text" class="form-control" id="inputBname" placeholder="hello@sfinx.lt" v-model="instagram">
                            </div>
                            <div class="form-group col-md-8">
                                <label for="inputBname">Pastabos, komentarai</label>
                                <textarea type="text" class="form-control" id="inputBname" placeholder="----APRASYMA RASYKITE CIA----" v-model="description"></textarea>
                            </div>
                        </div>
                        <a href="#" class="btn btn-primary" v-on:click="memberCreate">Prideti nari</a>
        </div>
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
      }
    },
    methods: {
      //console.log('mounted');

      memberCreate: function(){
        axios.post('api/members/store', {
          firstName: '-',
          lastName: this.fullName,
          primaryPhone: this.primaryPhone,
          description: this.description,
        }).then(response => {
          if (response.data.status == 'OK')
          {
            console.log('SUCCESS');
            this.$router.push('/groups');
          }else{
            console.log(response.data);
          }
        });
      }
    }
  }
</script>

<style>
</style>