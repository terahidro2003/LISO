<template>
  <div class="container">
    <div class="sectionHeader mb-4" v-if="member in members">
      <div style=" width: auto; height: auto; display: flex; flex-direction: row; justify-content: space-between;">
      <h1>{{member.firstName}} {{member.lastName}}</h1>
      <button class="btn btn-primary" onclick="newPayment({{$data->id}});" v-if="member.VIP == 'yes'" disabled @endif>
        <span class="icon icon-white" data-feather="dollar-sign"></span>
      </button>
    </div>
    </div>
      <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header"><h3 class="card-title">Nario anketa</h3></div>
                  <div class="card-body">
                      <form method="POST" action="">
                          <div class="form-row">
                              <div class="form-group col-md-4">
                                  <label for="inputBname">Gimimo data</label>
                                  <input type="date" name="birthDate" class="form-control" id="inputBname" v-model="member.birthDate">
                              </div>
                              <div class="form-group col-md-4">
                                  <label for="inputBname">Pagr. telefono numeris</label>
                                  <input type="text" name="primaryPhone" class="form-control" id="inputBname" placeholder="Telefono numeris" v-model="member.primaryPhone">
                              </div>
                              <div class="form-group col-md-4">
                                  <label for="inputBname">Grupe</label>
                                  <select class="form-control form-control-danger" name="group" disabled>
                                  </select>
                              </div>
                          </div>
                          <button type="submit" class="btn btn-primary">Patvirtinti</button>

                          <button class="btn btn-danger" onclick="deleteMember()">
                             <span class="icon icon-white" data-feather="trash"></span> Pašalinti narį
                          </button>
                      </form>
                  </div>
              </div>
          </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Atleisti nuo mokėjimų</h3>
              <div class="card-options">
                <label class="custom-switch m-0">
                  <input type="checkbox" value="1" class="custom-switch-input" checked>
                  <span class="custom-switch-indicator"></span>
                </label>
              </div>
            </div>
            <div class="card-body">
              Aktyvavus šią funkciją, narys bus atleistas nuo fiksuoto mėnesinio mokęsčio, išskyrus nuo mokėjimų už konkursus ir pan.
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Pakeisti nario mokęsti</h3>
            </div>
            <div class="card-body">
              <div class="input-icon">
                <span class="input-icon-addon">
                  <i data-feather="dollar-sign"></i>
                </span>
                <input type="text" class="form-control" placeholder="Kaina per mėn." value="">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header flex-inline">
              <h2 class="vertical-align">RFID korteles ir apyrankes</h2>
              <div class="actionButtons">
                <button class="btn btn-primary" onclick="" >Priskirti kortele</button>
                <button class="btn btn-danger" onclick="">
                	<span class="icon-white" data-feather="delete"></span>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="alert alert-warning">Yra priskirta daugiau nei viena RFID kortele</div>
            </div>
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h2>Visi nario atlikti mokejimai</h2>
            </div>
            <div class="card-body">
              <table class="table">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Suma</th>
                                    <th>Pastabos</th>
                                    <th>Atliktas</th>
                                    <th>Veiksmai</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
            </div>
          </div>
        </div>
      </div>
       <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header flex-inline">
              <h2 class="vertical-align">Apsilankymai</h2>
            </div>
            <div class="card-body">
               <table class="table">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Data ir laikas</th>
                                    <th>RFID</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-header flex-inline">
              <h2 class="vertical-align">Spinteles</h2>
            </div>
            <div class="card-body">
                <div class="alert alert-primary">Kolkas neprieinama</div>
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
      groups: [],
      membersCount: null,
    }
  },
  methods: {
    /*
    Following bugs detected:
    1. All studio option is not working correctly
    2. Filters can't work together
    */
    showEditDialog(id){
      this.$router.push('/members/'+id+'/edit');
    },

    filterTable(inputType, event){
      if(inputType === 'city'){
        if(event.target.value != 0){
          var reqURL = "api/members/filter/city/" + event.target.value;
          axios.get(reqURL).then(response => {
            this.API_results = response.data;
          });
        }
      }

      if(inputType === 'group'){
        var reqURL = "api/members/filter/group/" + event.target.value;
        axios.get(reqURL).then(response => {
          this.API_results = response.data;
        });
      }
    }
  },
  mounted() {
    axios.get('/api/members').then(response => {
      this.API_results = response.data;
      this.membersCount = response.data.length;
    });
    axios.get('/api/groups').then(response => {
      this.groups = response.data;
    });
  }
}
</script>
