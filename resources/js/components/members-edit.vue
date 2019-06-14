<template>
<div>
  <div class="page-header mb-4" v-for="member in API_results.member">
      <div class="description">
        <h3>Redaguoti nari</h3>
        <h1>{{fullName}}</h1>
      </div>
      <div class="ml-5 stats">
         <div class="actions">
          <router-link to="/members" class="btn btn-muted">
            <span>Atgal</span>
          </router-link>
        </div>
      </div>
    </div>

    <div class="page-content justify-content-center" v-for="member in API_results.member">
    <div class="row">
      <div class="col-md-12 card card-big">
        <div class="card-body">
          <div class="col-md-12">
                          <div class="form-row">
                              <div class="col-md-4">
                                  <button @click="" class="btn btn-primary">Naujas mokejimas</button>
                              </div>
                          </div>
          </div>
        </div>
      </div>
      <div class="col-md-12 card card-big">
         <div class="alert alert-success" v-if="operationStatus">
          <h2 style="text-transform: uppercase;color: #fff;font-weight: bolder;">Operacija sekmingai atlikta!</h2>
          <h4>Dziaugemes us Jus!</h4>
        </div>
        <div class="alert alert-danger" v-if="serverError">
          <h2 style="text-transform: uppercase;color: #fff;font-weight: bolder;">Serverio klaida</h2>
          <h4>Pabandykite atlikti si veiksma po keletos minuciu ir jei tai nepadeda susisiekite su techninio aptarnavimo personalu</h4>
          <h5 style="color: #fff;">Klaidos tekstas: {{serverErrorMessage}} </h5>
        </div>
        <div class="alert alert-danger" v-if="alreadyExcists">
          <h2 style="text-transform: uppercase;color: #fff;font-weight: bolder;">Toks narys jau egzistuoja</h2>
          <h4>Pasinaudokite paieska ir suraskite ji</h4>
          <h5 style="color: #fff;">Klaidos tekstas: {{serverErrorMessage}} </h5>
        </div>
         <div class="alert alert-warning" v-if="validationFailed">
          <h2 style="text-transform: uppercase;color: #fff;font-weight: bolder;">Neuzpildyti visi butini laukeliai</h2>
          <h4>Dar karta perziurekite raudonai pazymetus laukelius</h4>
        </div>
        <div class="card-header">
          <h2>Pagrindine informacija</h2>
        </div>
        <div class="card-body">
          <div class="col-md-12">
                          <div class="form-row">
                            <div class="form-group col-md-6">
                                  <div class="description">
                                    <h3>Asmenine informacija</h3>
                                  </div>
                            </div>
                          </div>
                          <div class="form-row">
                            <div class="form-group col-md-6">
                              <label for="inputBname">Miestas</label>
                              <select class="form-control form-control-select" v-model="city" v-bind:class="{form_control_danger: city_required}">
                                <option value="vilnius">Vilnius</option>
                                <option value="Klaipeda">Klaipeda</option>
                              </select>
                              <label class="text-danger" v-if="city == null || city == ''">Šis laukelis privalomas</label>
                            </div>
                            <div class="form-group col-md-6">
                              <label for="inputBname">Gimimo data</label>
                              <input type="date" class="form-control" id="inputBname" placeholder="" v-model="birthDate" v-bind:class="{form_control_danger: birthDate_required}">
                              <label class="text-danger" v-if="birthDate == ''">Šis laukelis privalomas</label>
                            </div>
                          </div>
                          <div class="form-row">
                            <div class="form-group col-md-6">
                                  <div class="description">
                                    <h3>Kontaktine informacija</h3>
                                  </div>
                            </div>
                          </div>
                          <div class="form-row">
                              <div class="form-group col-md-4">
                                  <label for="inputBname">Telefono numeris</label>
                                  <input type="tel" class="form-control" id="inputBname" placeholder="+3706xxxxx" v-model="primaryPhone" v-bind:class="{form_control_danger: primaryPhone_required}">
                                  <label class="text-danger" v-if="primaryPhone == ''">Šis laukelis privalomas</label>
                              </div>
                              <div class="form-group col-md-4">
                                  <label for="inputBname">Antras telefono numeris</label>
                                  <input type="tel" class="form-control" id="inputBname" placeholder="+3706xxxxx" v-model="secondaryPhone" v-bind:class="{form_control_danger: secondaryPhone_required}">
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
                          </div>
                           <div class="form-row mt-5 mb-0">
                                <div class="form-group col-md-6">
                                      <div class="description">
                                        <h3>Asmenine informacija</h3>
                                      </div>
                                </div>
                            </div>
                            <div class="form-row">
                              <div class="form-group col-md-8">
                                  <label for="inputBname">Pastabos, komentarai</label>
                                  <textarea type="text" class="form-control" id="inputBname" placeholder="----APRASYMA RASYKITE CIA----" v-model="description"></textarea>
                              </div>
                            </div>


                            <div class="form-row mt-5 mb-0">
                                 <div class="form-group col-md-6">
                                       <div class="description">
                                         <h3>Mokejimu informacija</h3>
                                         <label class="bg-label bg-label-success" v-if="balance == 0">Geras mokumas</label>
                                         <label class="bg-label bg-label-warning" v-if="balance > 0">Permoka</label>
                                         <label class="bg-label bg-label-danger" v-if="balance < 0">Blogas mokumas</label>
                                       </div>
                                 </div>
                             </div>

                             <div class="form-row">
                               <div class="form-group col-md-6">
                                   <label for="inputBname">Menesinis mokestis</label>
                                   <input class="form-control" placeholder="" v-model="fee"/>
                               </div>
                               <div class="form-group col-md-6">
                                   <label for="inputBname">Dabartinis balansas</label>
                                   <input class="form-control" placeholder="" v-model="balance" style="border: none !important;" disabled/>
                               </div>
                             </div>

                          <a href="#" class="btn btn-primary" v-on:click="memberCreate">Atnaujinti informacija</a>
          </div>
        </div>
      </div>
      <div class="col-md- card">
         <div class="alert alert-success" v-if="operationStatus">
          <h2 style="text-transform: uppercase;color: #fff;font-weight: bolder;">Operacija sekmingai atlikta!</h2>
          <h4>Dziaugemes us Jus!</h4>
        </div>
        <div class="alert alert-danger" v-if="serverError">
          <h2 style="text-transform: uppercase;color: #fff;font-weight: bolder;">Serverio klaida</h2>
          <h4>Pabandykite atlikti si veiksma po keletos minuciu ir jei tai nepadeda susisiekite su techninio aptarnavimo personalu</h4>
          <h5 style="color: #fff;">Klaidos tekstas: {{serverErrorMessage}} </h5>
        </div>
        <div class="alert alert-danger" v-if="alreadyExcists">
          <h2 style="text-transform: uppercase;color: #fff;font-weight: bolder;">Toks narys jau egzistuoja</h2>
          <h4>Pasinaudokite paieska ir suraskite ji</h4>
          <h5 style="color: #fff;">Klaidos tekstas: {{serverErrorMessage}} </h5>
        </div>
         <div class="alert alert-warning" v-if="validationFailed">
          <h2 style="text-transform: uppercase;color: #fff;font-weight: bolder;">Neuzpildyti visi butini laukeliai</h2>
          <h4>Dar karta perziurekite raudonai pazymetus laukelius</h4>
        </div>
        <div class="card-header">
          <h2>Mokejimu istorija</h2>
        </div>
        <div class="card-body">
          <div class="col-md-12">

                          <div class="form-row">
                            <div class="form-group col-md-12">
                              <table class="table card-table table-vcenter text-nowrap datatable dataTable no-footer">
                                  <thead>
                                      <tr>
                                          <th>Mokejimo nr.</th>
                                          <th>Vadybininkas/Treneris</th>
                                          <th>Uz nurodyta men.</th>
                                          <th>Ankstesnes skolos</th>
                                          <th>Galutine suma</th>
                                          <th>Veiksmai</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                          <tr>
                                              <td> XR-6206 </td>
                                              <td> Karolis Paradnikas </td>
                                              <td> 35 Eur. </td>
                                              <td> 0 Eur. </td>
                                              <td> 35 Eur. </td>
                                              <td>
                                                  <span href="" class="link" @click="showEditDialog(result.id)">Redaguoti</span>
                                              </td>
                                          </tr>
                                  </tbody>
                              </table>
                            </div>
                          </div>
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
        MemberID: this.$route.params.id,
        operationStatus: false,
        serverError: null,
        serverErrorMessage: null,
        validationFailed: null,
        alreadyExcists: false,
        fullName: null,
        fullName_required: false,
        birthDate: null,
        birthDate_required: false,
        primaryPhone: null,
        primaryPhone_required: false,
        secondaryPhone: null,
        secondaryPhone_required: false,
        email: null,
        email_required: false,
        instagram: null,
        instagram_required: false,
        facebook: null,
        facebook_required: false,
        description: null,
        description_required: false,
        city: null,
        city_required: false,
        balance: null,
        fee: null,
        API_results: null,
      }
    },
    mounted() {
      axios.get('/api/members/'+this.MemberID).then(response => {
        this.API_results = response.data;
        this.balance = response.data.balance;

        this.fullName = this.API_results.member.firstName + " " + this.API_results.member.lastName;
        this.birthDate = this.API_results.member.birthDate;
        this.primaryPhone = this.API_results.member.primaryPhone;
        this.secondaryPhone = this.API_results.member.secondaryPhone;
        this.email = this.API_results.member.email;
        this.instagram = this.API_results.member.instagram;
        this.facebook = this.API_results.member.facebook;
        this.description = this.API_results.member.description;
        this.city = this.API_results.member.city;
        this.balance = this.API_results.member.balance;
        this.fee = this.API_results.member.fee;
      });
    },
    methods: {
      memberCreate: function(){
        var verificationStatus = false;
        if(this.fullName == '' || this.fullName == null) { this.fullName_required = true; verificationStatus = false }
        if(this.primaryPhone == '' || this.primaryPhone == null) { this.primaryPhone_required = true;verificationStatus = false }
        if(this.birthDate == '' || this.birthDate == null) { this.birthDate_required = true; verificationStatus = false }
        if(this.city == '' || this.city == null) { this.city_required = true; verificationStatus = false }

        var fullFullName = this.fullName.split(" ");
        axios.post('api/members/update', {
          firstName: fullFullName[0],
          lastName: fullFullName[1],
          primaryPhone: this.primaryPhone,
          secondaryPhone: this.secondaryPhone,
          email: this.email,
          instagram: this.instagram,
          facebook: this.facebook,
          fee: this.fee,

          birthDate: this.birthDate,
          description: this.description,
          city: this.city,
        }).then(response => {
          if (response.data.status == 'OK')
          {
            this.operationStatus = true;
            setTimeout(this.$router.push('/members'), 3000);
          }else{
            if(response.data.cause == 1){
              this.validationFailed = true;
            }else{
              this.serverError = true;
              this.serverErrorMessage = response.data;
            }

            if(response.data.cause == 3){this.alreadyExcists = true}
            console.log(response.data);
          }
        });
      }
    }
  }
</script>

<style>
</style>
