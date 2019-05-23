<template>
  <div>
  <div class="page-header mb-4">
      <div class="description">
        <h3>Grupes</h3>
        <h1>Visos grupes</h1>
      </div>
    </div>
    <div class="page-content justify-content-center">
            <div class="card big">
                <div class="card-header flex-s">
                  <h2 class="vertical-align">Grupes</h2>
                </div>

                <div class="card-body">
                    <table class="table card-table table-vcenter text-nowrap datatable dataTable no-footer">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Pavadinimas</th>
                                <th>Veiksmai</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr v-for="result in API_results">
                                    <td> {{result.id}} </td>
                                    <td> {{result.groupName}} </td>
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

      axios.get('/api/groups').then(response => {
        this.API_results = response.data;

      });
    }
  }
</script>

<style>
</style>