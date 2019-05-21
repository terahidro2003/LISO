<template>
  <div>
	<div class="page-header mb-4">
      <div class="description">
        <h3>Sveiki sugrize!</h3>
        <h1>Pagrindinis</h1>
      </div>
      <div class="ml-5 stats">
        <div class="stat mr-5">
          <span class="mt-1 status status-ok"></span>
          <h1 class="number mt-3 ml-2">143</h1>
          <div class="txt mt-2 ml-2">
            <h2>Nauju registraciju</h2>
            <h3>Nuo 2039-02-02</h3>
          </div>
        </div>

        <div class="stat">
          <span class="mt-1 status status-danger"></span>
          <h1 class="number mt-3 ml-2">43%</h1>
          <div class="txt mt-2 ml-2">
            <h2>Maziau registraciju</h2>
            <h3>Lyginant su 2039-02-02</h3>
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
    }
  }
</script>

<style>
</style>