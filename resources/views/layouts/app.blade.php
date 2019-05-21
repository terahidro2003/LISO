<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

   <script type="text/javascript">
      function ajaxSearch() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var contentBox = document.getElementById("searchD");
        if($("input[name=searchQ]").val() == ""){
          $("input[name=searchQ]").popover('hide');
          return;
         }
        $.ajax({
          url: "/api/search",
          type: 'POST',
          data: {_token: CSRF_TOKEN, message:$("input[name=searchQ]").val()},
          dataType: 'JSON',
          success: function(data) {
            console.log(data);
            contentBox.innerHTML = data.message;
            if(data.status == "error") {
                  $("input[name=searchQ]").popover('hide');
                  return;
            }

          }
            });
          }
    async function newPayment(ID){
      const {value: group} = await Swal.fire({
        title: 'Naujas mokejimas',
        input: 'text',
        inputPlaceholder: 'Suma',
        showCancelButton: true,
        confirmButtonText: 'Patvirtinti',
        showLoaderOnConfirm: true,
        preConfirm: (value) => {
          $.ajax({
              url: '/payments/new',
              type: 'POST',
              headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              data: {
                id: ID,
                price: value,
              },
              dataType: 'JSON',
              success: function(data) {
                if (data.status != 'OK'){
                  if (data.cause == 1){
                    Swal.fire({
                      type: 'error',
                      title: 'Klaida!',
                      text: 'Procedūra neįvyko veikiausiai dėl sistemos klaidos.',
                      footer: '<a href>Susisiekti su techniniu personalu</a>'
                    });
                  }
                  if (data.cause == 2){
                    Swal.fire({
                      type: 'error',
                      title: 'Klaida!',
                      text: 'Registracija su tokiais duomenimis neegzistuoja. Prašome patikrinti duomenis.',
                      footer: '<a href>Kodel yra susiduriama su sia problema?</a>'
                    });
                  }
                  if(data.cause == 3){
                    Swal.fire({
                      type: 'error',
                      title: 'Klaida!',
                      text: 'Narys jau yra registruotas sistemoje',
                      footer: '<a href>Kodel yra susiduriama su sia problema?</a>'
                    });
                  }

                  console.log('FAILED');
                }else{
                  Swal.fire({
                    type: 'success',
                    title: 'Apmokejimas pavyko!',
                    text: 'Mokejimas buvo atliktas sekmingai',
                  });
                  location.reload();
                }
              }
            });
        }

      });
    }

    async function scanRFID(){
      const {value: group} = await Swal.fire({
        title: 'Nuskenuokite RFID irengini',
        input: 'text',
        inputPlaceholder: 'RFID korteles duomenys',
        showCancelButton: true,
        confirmButtonText: 'Patvirtinti',
        showLoaderOnConfirm: true,
        preConfirm: (value) => {
          $.ajax({
              url: '/rfid/scan',
              type: 'POST',
              headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              data: {
                RFID: value,
              },
              dataType: 'JSON',
              success: function(data) {
                if (data.status != 'OK'){
                  if (data.cause == 1){
                    Swal.fire({
                      type: 'error',
                      title: 'Klaida!',
                      text: 'Procedūra neįvyko veikiausiai dėl sistemos klaidos.',
                      footer: '<a href>Susisiekti su techniniu personalu</a>'
                    });
                  }
                  if (data.cause == 2){
                    Swal.fire({
                      type: 'warning',
                      title: 'Kortele siandien jau buvo nuskaityta!',
                      text: 'Prašome patikrinti duomenis.',
                      footer: '<a href>Kodel yra susiduriama su sia problema?</a>'
                    });
                  }
                  if(data.cause == 3){
                    Swal.fire({
                      type: 'error',
                      title: 'Klaida!',
                      text: 'Nuskenuotas neatpazintas RFID irenginys',
                      footer: '<a href>Kodel yra susiduriama su sia problema?</a>'
                    });
                  }

                  console.log('FAILED');
                }else{
                  Swal.fire({
                    type: 'success',
                    title: data.firstName + " " + data.lastName,
                    text: 'Kortele nuskenuota sekmingai',
                  });
                }
              }
            });
        }

      });
    }
   </script>
</head>
<body>
    <div id="app">
      <header id="topNavigation">

              <div class="firstSide">
                        <div class="logo">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 88 88"><rect width="88" height="88" fill="#4062bb"/><g transform="translate(28 28)"><path d="M0,0H32V32H0Z" fill="none"/><path d="M4.444,17.444h8.667A1.449,1.449,0,0,0,14.556,16V4.444A1.449,1.449,0,0,0,13.111,3H4.444A1.449,1.449,0,0,0,3,4.444V16A1.449,1.449,0,0,0,4.444,17.444ZM4.444,29h8.667a1.449,1.449,0,0,0,1.444-1.444V21.778a1.449,1.449,0,0,0-1.444-1.444H4.444A1.449,1.449,0,0,0,3,21.778v5.778A1.449,1.449,0,0,0,4.444,29Zm14.444,0h8.667A1.449,1.449,0,0,0,29,27.556V16a1.449,1.449,0,0,0-1.444-1.444H18.889A1.449,1.449,0,0,0,17.444,16V27.556A1.449,1.449,0,0,0,18.889,29ZM17.444,4.444v5.778a1.449,1.449,0,0,0,1.444,1.444h8.667A1.449,1.449,0,0,0,29,10.222V4.444A1.449,1.449,0,0,0,27.556,3H18.889A1.449,1.449,0,0,0,17.444,4.444Z" transform="translate(0 0)" fill="rgba(255,255,255,0.5)"/></g></svg>
                        </div>
                        <div class="ml-5 mt-4 description">
                          <div class="text">
                            <h3>Šokių studija</h3>
                            <h1>VŠĮ, SFINX</h1>
                          </div>
                        </div>
              </div>

              <div class="secondSide">
                          <div class="items">
                            <a class="item">
                                <span data-feather="search" class="icon"></span>
                            </a>
                            <a class="item">
                                <span data-feather="user" class="icon"></span>
                            </a>
                          </div>
              </div>
      </header>
      <div id="sideNavigation">
                <div class="items">
                   <router-link to="/home" class="item">
                     <span class="icon" data-feather="home"></span>
                   </router-link>
                    <router-link to="/stats" class="item">
                      <span class="icon" data-feather="bar-chart"></span>
                    </router-link>
                    <router-link to="/signups" class="item">
                      <span class="icon" data-feather="layers"></span>
                    </router-link>
                    <router-link to="/groups" class="item"><span class="icon" data-feather="home"></span></router-link>
                    <router-link to="/members" class="item">
                      <span class="icon" data-feather="user"></span>
                    </router-link>
                    <router-link to="/settings" class="item">
                      <span class="icon" data-feather="hard-drive"></span>
                    </router-link>
                    <router-link to="/payments" class="item">
                      <span class="icon" data-feather="dollar-sign"></span>
                    </router-link>

                </div>
                <div class="footer">

                </div>
      </div>


      <main class="content">
        <router-view></router-view>
      </main>

        <button class="btn btn-primary btn-rounded bottomAction" onclick="scanRFID();">
        	<span style="display: none;">-</span> <span class="icon-white" data-feather="credit-card"></span> <span style="display: none;">-</span>
        </button>
    </div>
</body>
</html>
