<template>
<div>
  <div class="page-header mb-4">
      <div class="description">
        <h3>Siuo metu dalyvauja</h3>
        <h1>Vardenis Pavardenis</h1>
      </div>
      <div class="ml-5 stats">
        <div class="stat mr-5">
          <span class="mt-1 status status-ok"></span>
          <h1 class="number mt-3 ml-2">20/123</h1>
          <div class="txt mt-2 ml-2">
            <h2>Dalyvavo sokeju</h2>
            <h3>Pask. karta atnaujinta 10:33:44</h3>
          </div>
        </div>

        <div class="stat">
          <span class="mt-1 status status-danger"></span>
          <h1 class="number mt-3 ml-2">5/123</h1>
          <div class="txt mt-2 ml-2">
            <h2>Atsisake ar negalejo dalyvauti</h2>
            <h3>Pask. karta atnaujinta 10:33:44</h3>
          </div>
        </div>
      </div>
      <div class="ml-5 stats">
         <div class="actions">
          <router-link to="/groups" class="btn btn-small btn-warning">
            <span data-feather="x-circle" class="icon"></span>
            <span>Ankstesnis</span>
          </router-link>
          <router-link to="/groups" class="btn btn-small btn-danger">
            <span data-feather="x-circle" class="icon"></span>
            <span>Baigti vertinima</span>
          </router-link>
        </div>
      </div>
    </div>

    <div class="page-content justify-content-center">
        <div class="col-md-12">
                  <form method="POST" action="">
                            <div class="form-group col-md-12">
                                <label for="inputBname">Vertinimas</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                      <input type="radio" name="value" value="100" class="selectgroup-input">
                                      <span class="selectgroup-button">1</span>
                                    </label>
                                    <label class="selectgroup-item">
                                      <input type="radio" name="value" value="100" class="selectgroup-input">
                                      <span class="selectgroup-button">2</span>
                                    </label>
                                    <label class="selectgroup-item">
                                      <input type="radio" name="value" value="100" class="selectgroup-input">
                                      <span class="selectgroup-button">3</span>
                                    </label>
                                    <label class="selectgroup-item">
                                      <input type="radio" name="value" value="100" class="selectgroup-input">
                                      <span class="selectgroup-button">4</span>
                                    </label>
                                    <label class="selectgroup-item">
                                      <input type="radio" name="value" value="100" class="selectgroup-input">
                                      <span class="selectgroup-button">5</span>
                                    </label>
                                    <label class="selectgroup-item">
                                      <input type="radio" name="value" value="100" class="selectgroup-input">
                                      <span class="selectgroup-button">6</span>
                                    </label>
                                    <label class="selectgroup-item">
                                      <input type="radio" name="value" value="100" class="selectgroup-input">
                                      <span class="selectgroup-button">7</span>
                                    </label>
                                    <label class="selectgroup-item">
                                      <input type="radio" name="value" value="100" class="selectgroup-input">
                                      <span class="selectgroup-button">8</span>
                                    </label>
                                    <label class="selectgroup-item">
                                      <input type="radio" name="value" value="100" class="selectgroup-input">
                                      <span class="selectgroup-button">9</span>
                                    </label>
                                    <label class="selectgroup-item">
                                      <input type="radio" name="value" value="100" class="selectgroup-input">
                                      <span class="selectgroup-button">10</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="inputBname">Papildomi komentarai</label>
                                <textarea type="text" name="description" class="form-control" id="inputBname" placeholder="----APRASYMA RASYKITE CIA----"></textarea>
                            </div>
                        <button type="submit" class="btn btn-primary">Pateikti vertinima</button>
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