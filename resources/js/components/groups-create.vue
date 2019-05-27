<template>
<div>
  <div class="page-header mb-4">
      <div class="description">
        <h3>Sukurti nauja grupe</h3>
        <h1>Grupes</h1>
      </div>
      <div class="ml-5 stats">
         <div class="actions">
          <router-link to="/groups" class="btn btn-danger">
            <span data-feather="x-circle" class="icon"></span>
            <span>Atsaukti</span>
          </router-link>
        </div>
      </div>
    </div>

    <div class="page-content justify-content-center">
        <div class="col-md-12">
                  <form method="POST" action="">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputFname">Grupes pavadinimas</label>
                                <input type="text" name="groupName" class="form-control form-control-lg" id="inputFname" placeholder="Pavadinimas">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputBname">Treneris</label>
                                <input type="text" name="leader" class="form-control" id="inputBname" placeholder="Vardenis Pavardenis">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputBname">Lygis</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                      <input type="radio" name="value" value="100" class="selectgroup-input">
                                      <span class="selectgroup-button">Pradinis</span>
                                    </label>
                                    <label class="selectgroup-item">
                                      <input type="radio" name="value" value="100" class="selectgroup-input">
                                      <span class="selectgroup-button">Vidutinis</span>
                                    </label>
                                    <label class="selectgroup-item">
                                      <input type="radio" name="value" value="100" class="selectgroup-input">
                                      <span class="selectgroup-button">Pazengusiuju</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="inputBname">Aprasymas</label>
                                <textarea type="text" name="description" class="form-control" id="inputBname" placeholder="----APRASYMA RASYKITE CIA----"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Sukurti nauja grupe</button>
                    </form>
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