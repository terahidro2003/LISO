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
    </script>
</head>
<body>
    <div id="app">
        <header id="topNavigation">
            <div class="items">
              <form action="{{route('search.form')}}" method="post">
                @csrf
                <input type="text" class="searchField form-control" placeholder="Paieska" name="searchQ" id="searchQ" onkeyup="ajaxSearch();">
              </form>
            </div>
            <div class="align">
                @auth
                <span class="mr-2 clickable">
                    <span data-feather="bell" class="icon"></span>
                </span>
                <span class="clickable">
                    <span data-feather="user" class="icon"></span>
                    Mano paskyra
                </span>
                @endauth
            </div>
        </header>
        <div id="sideNavigation">
            <div class="items">
               <a href=" {{route('home') }} " class="item @if (Route::currentRouteName() == "home" || Route::currentRouteName() == "search.form") active @endif">Pagrindinis</a>
                <a href=" {{route('viewSignups') }} " class="item @if (Route::currentRouteName() == "viewSignups") active @endif">Registracijos</a>
                <a href=" {{route('members.index') }} " class="item @if(strpos(Route::currentRouteName(), 'members') !== false) active @endif">Nariai</a>
                <a href=" {{route('groups.index') }} " class="item @if(strpos(Route::currentRouteName(), 'groups') !== false) active @endif">Grupes</a>
                <a href="{{route('rfid.index')}}" class="item @if(strpos(Route::currentRouteName(), 'rfid') !== false) active @endif">Korteles ir apyrankes</a>
                <a href="{{route('stats.studio')}}" class="item @if(strpos(Route::currentRouteName(), 'stats') !== false) active @endif">Statistika</a>
                 <a href="{{route('stats.studio')}}" class="item">Registras</a>
            </div>
            <div class="footer">
                <h6>SpruceBird Innovations, 2019</h6>
            </div>
        </div>

        <main class="content">
            @yield('content')
        </main>
    </div>
</body>
</html>
