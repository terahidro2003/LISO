<template>
  <div>
	<div class="page-header mb-4">
      <div class="description">
        <h3>Registracijos</h3>
        <h1>Nepatvirtintos registracijos</h1>
      </div>
      <div class="ml-5 stats">
        <div class="stat mr-5">

          <span class="mt-1 status status-ok" v-if="newSignups.count > 0"></span>
          <span class="mt-1 status status-danger" v-if="newSignups.count <= 0"></span>
          <h1 class="number mt-3 ml-2"><span class="count">{{newSignups.count}}</span></h1>
          <div class="txt mt-2 ml-2">
            <h2>Nauju registraciju</h2>
            <h3>Nuo {{newSignups.date}}</h3>
          </div>
        </div>
      </div>
    </div>

    <div class="mt-5 mb-5 filter">
        <div class="justify-content-center w-50">
          <div class="row">
             <div class="col">
              <label class="label">Miestas</label>
              <select class="form-control white" name="group" @change="filterTable('city', $event)">
                  <option value="1">Klaipeda</option>
                  <option value="2">Vilnius</option>
              </select>
            </div>
          </div>
        </div>
    </div>
    <div class="page-content justify-content-center">
            <div class="card big">
                <div class="card-header flex-s">
                  <h2 class="vertical-align">Nepatvirtintos registracijos</h2>
                </div>

                <div class="card-body">
                	<div class="alert alert-warning" v-if="API_results.length === 0">
						Nerasta
                	</div>
                    <table v-if="API_results.length > 0" class="table card-table table-vcenter text-nowrap datatable dataTable no-footer">
                        <thead>
                            <tr>
                                <th>Vardas</th>
                                <th>Pavarde</th>
                                <th>Gimimo data</th>
                                <th>Telefono numeris</th>
                                <th>Veiksmai</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr v-for="result in API_results">
                                    <td> {{result.firstName}} </td>
                                    <td> {{result.lastName}} </td>
                                    <td> {{result.birthDate}} </td>
                                    <td> {{result.primaryPhone}} </td>
                                    <td>
                                        <a href="#confirm" class="link" @click="showConfirmMemberModal = true">Patvirtinti</a>
                                        <a href="#confirm" class="link" onclick="deleteMember(result.id);">Istrinti</a>
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
        newSignups: null,
  		}
  	},
  	methods: {
  		filterTable(inputType, event){
  			if(inputType === 'city'){
  				var reqURL = "api/signups/filter/city/" + event.target.value;
	  			axios.get(reqURL).then(response => {
	  				this.API_results = response.data;
	  			});
  			}
  		}
  	},
    mounted() {
      console.log('mounted');

      axios.get('/api/signups').then(response => {
      	this.API_results = response.data
      });

      axios.get('/api/stats/signups/1').then(response => {
        this.newSignups = response.data;
      });
    }
  }
</script>

<style>
</style>
