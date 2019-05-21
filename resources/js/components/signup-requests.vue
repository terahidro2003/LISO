<template>
  <div>
	<div class="page-header mb-4">
      <div class="description">
        <h3>Registracijos</h3>
        <h1>Nepatvirtintos registracijos</h1>
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

    <div class="mt-5 mb-5 filter">
        <div class="justify-content-center">
          <div class="row">
            <div class="col">
              <label class="label">Grupe</label>
              <select class="form-control white" name="group">
                  <option value="0">Visa studija</option>
                  <option value="0">Squad</option>
              </select>
            </div>

            <div class="col">
              <label class="label">Menuo</label>
              <select class="form-control white" name="group">
                  <option value="0">Sausis</option>
                  <option value="0">Vasaris</option>
              </select>
            </div>

            <div class="col">
              <label class="label">Metai</label>
              <select class="form-control white" name="group">
                  <option value="0">2019</option>
                  <option value="0">2018</option>
              </select>
            </div>

             <div class="col">
              <label class="label">Miestas</label>
              <select class="form-control white" name="group">
                  <option value="0">Klaipeda</option>
                  <option value="0">Vilnius</option>
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
                    <table class="table card-table table-vcenter text-nowrap datatable dataTable no-footer">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Vardas</th>
                                <th>Pavarde</th>
                                <th>Gimimo data</th>
                                <th>Telefono numeris</th>
                                <th>Veiksmai</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr v-for="result in API_results">
                                    <td> {{result.id}} </td>
                                    <td> {{result.firstName}} </td>
                                    <td> {{result.lastName}} </td>
                                    <td> {{result.birthDate}} </td>
                                    <td> {{result.primaryPhone}} </td>
                                    <td>
                                        <a href="#confirm" class="link" onclick="confirmMember(result.id);">Patvirtinti</a>
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
  			API_results: []
  		}
  	},
    mounted() {
      console.log('mounted');

      axios.get('/api/signups').then(response => {
      	this.API_results = response.data
      });
    }
  }
</script>

<style>
</style>