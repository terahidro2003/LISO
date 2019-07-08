<template>
  <div>
	<div class="page-header mb-4">
      <div class="description">
        <h3>Nariai</h3>
        <h1>Mokėjimai ir finansai</h1>
      </div>
      <!-- <div class="ml-5 stats">
        <div class="stat mr-5">
          <span class="mt-1 status status-ok"></span>
          <h1 class="number mt-3 ml-2">657 Eur</h1>
          <div class="txt mt-2 ml-2">
            <h2>Daugiau pajamų šį mėnesį</h2>
            <h3>Nuo 2039-02-02</h3>
          </div>
        </div>

        <div class="stat">
          <span class="mt-1 status status-danger"></span>
          <h1 class="number mt-3 ml-2">43%</h1>
          <div class="txt mt-2 ml-2">
            <h2>Mažesnis mokumas procentais</h2>
            <h3>Lyginant su 2039-02-02</h3>
          </div>
        </div>
      </div> -->
    </div>


    <div class="page-content justify-content-center">
            <div class="card big col-md-12">
                <div class="card-header flex-s">
                  <h2 class="vertical-align">Visi mokejimai</h2>
                </div>

                <div class="card-body">
                  <div class="alert alert-warning" v-if="API_results.length == null || API_results == '' || API_results.length == 0">
                    <span>Nerasta atliktų mokėjimų sistemoje</span>
                  </div>


                    <table class="table table-hover table-outline table-vcenter text-nowrap card-table" v-if="API_results.length != 0">
                        <thead>
                            <tr>
                                <th>Vardas, pavardė</th>
                                <th>Suma</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr v-for="result in API_results">
                                    <td>
                                      <div>{{result.firstName}} {{result.lastName}}</div>
                                      <div class="small text-muted">Mokėjimas atliktas: {{result.created_at}}</div>
                                    </td>
                                    <td>
                                      {{result.price}}
                                      <div class="small text-muted">euru</div>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" @click="deleteMember(result.id)"><i class="dropdown-icon fe fe-trash"></i></a>
                                        <!-- <div class="item-action dropdown">
                                          <a href="javascript:void(0)" data-toggle="dropdown" class="icon icon-table" aria-expanded="false"><i class="fe fe-more-vertical"></i></a>
                                          <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(15px, 20px, 0px); top: 0px; left: 0px; will-change: transform;">

                                          </div>
                                        </div> -->
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                    <div class="alert alert-warning" v-if="API_results == null">
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
        desptorResults: [],
  		}
  	},
    mounted() {

      axios.get('/api/payments').then(response => {
          this.API_results = response.data;
        });

      axios.get('/api/payments/deptors').then(response => {
          this.desptorResults = response.data;
        });
    }
  }
</script>

<style>
</style>
