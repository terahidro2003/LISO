<template>
  <div>
  <div class="page-header mb-4">
      <div class="description">
        <h3>Grupės</h3>
        <h1>Visos grupės</h1>
      </div>
      <div class="ml-5 stats">
         <div class="actions">
          <router-link to="/groups/create" class="btn btn-primary">Sukurti grupę</router-link>
        </div>
      </div>
    </div>

    <div class="page-content justify-content-center">
      <div class="alert alert-info" v-if="API_results.length == 0">
        <span>Norėdami pilnavertiškai pradėti darbą su sistema, rekomenduojame sukurti bent vieną grupę</span>
      </div>
      <div class="row">
        <div class="col-md-4" v-for="group in API_results">
          <div class="card card-group">

            <div class="level-color level-color-first" v-if="group.level == 1"></div>
            <div class="level-color level-color-second" v-if="group.level == 2"></div>
            <div class="level-color level-color-third" v-if="group.level == 3"></div>
            <div class="level-color" style="background-color: black;" st v-if="group.level == null"></div>

            <div class="group-header">
              <h2 class="title">{{ group.groupName }}</h2>
            </div>

            <hr class="devider">

            <div class="quick-data row">
              <div class="col q-data">
                <h3 class="bolded">Nariai</h3>
                <h3>{{ group.members_count }}</h3>
              </div>
              <div class="col q-data">
                <h3 class="bolded">Mokumas</h3>
                <h3>XX</h3>
              </div>
              <div class="col q-data">
                <h3 class="bolded">Vid. pajamos</h3>
                <h3>XX</h3>
              </div>
            </div>

            <div class="quick-actions">
              <a href="#edit" @click="showUpdate(group.id)" class="link link-edit mr-3">Redaguoti</a>
            </div>
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
        API_results: [],
      }
    },
    methods: {
      showUpdate(id){
        this.$router.push('/groups/update/'+id);
      },
    },
    mounted() {
      console.log('mounted');

      axios.get('/api/groups').then(response => {
        this.API_results = response.data;
      });
    }
  }
</script>

<style>
</style>
