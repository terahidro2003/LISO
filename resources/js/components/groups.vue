<template>
  <div>
  <div class="page-header mb-4">
      <div class="description">
        <h3>Grupes</h3>
        <h1>Visos grupes</h1>
      </div>
      <div class="ml-5 stats">
         <div class="actions">
          <router-link to="/groups/create" class="btn btn-primary">Sukurti grupe</router-link>
        </div>
      </div>
    </div>

    <div class="page-content justify-content-center">
      <div class="row">
        <div class="col-md-4" v-for="group in API_results">
          <div class="card card-group">
            <div class="level-color"></div>

            <div class="group-header">
              <h2 class="title">{{ group.groupName }}</h2>
            </div>

            <hr class="devider">

            <div class="quick-data row">
              <div class="col q-data">
                <h3 class="bolded">Nariai</h3>
                <h3>{{ group.memberCount }}</h3>
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
              <a href="#edit" @click="" class="link link-edit mr-3">Redaguoti</a>
              <a href="#show" @click="" class="link link-show">Nariai</a>
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
        API_results: []
      }
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