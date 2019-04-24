@extends('layouts.app')

@section('content')
<script type="text/javascript">
   async function newGroup(){
    Swal.mixin({
      input: 'text',
      confirmButtonText: 'Sekantis &rarr;',
      showCancelButton: true,
      progressSteps: ['1', '2', '3']
  }).queue([
    {
      title: 'Grupes pavadinimas',
      text: 'Sugalvokite ir irasykite naujos grupes pavadinima'
    },
    'Grupes aprasymas',
    'Treneris'
  ]).then((result) => {
  if (result.value) {
      $.ajax({
              url: '/groups/store',
              type: 'POST',
              headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              data: {
                name: result.value[0],
                description: result.value[1],
                leader: result.value[2],
              },
              dataType: 'JSON',
              success: function(data) {
                if (data.status != 'OK'){
                    Swal.fire({
                      type: 'error',
                      title: 'Klaida!',
                      text: 'Procedūra neįvyko.',
                      footer: '<a href>Susisiekti su techniniu personalu</a>'
                    });
                  }
                else{
                  Swal.fire({
                    type: 'success',
                    title: 'Pavyko!',
                  });
                  location.reload();
                }
              }
            });
  }
});
  }
</script>
<div class="container">
   <div class="sectionHeader mb-4">
      <h1>Grupes</h1>
      {{ Breadcrumbs::render('groups') }}
    </div>
    <div class="justify-content-center">
            <div class="card big">
                <div class="card-header flex-inline">
                  <h2 class="vertical-align">Visos grupes</h2>
                  <div class="actionButtons">
                    <button class="btn btn-primary btn-small" onclick="newGroup();">Nauja grupe</button>
                  </div>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Pavadinimas</th>
                                <th>Treneris</th>
                                <th>Nariu kiekis</th>
                                <th>Aprasymas</th>
                                <th>Veiksmai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groups as $data)
                                <tr>
                                    <td> {{ $data->id }} </td>
                                    <td> {{ $data->groupName }} </td>
                                    <td> {{ $data->leader }} </td>
                                    <td>
                                      @if($data->members_count == 0)
                                        <label class="bg-label bg-label-main">Tuscia</label>
                                      @endif
                                      @if($data->members_count > 0) {{ $data->members_count }} @endif
                                    </td>
                                    <td> {{ $data->description }} </td>
                                    <td>
                                      <a href="{{ route('groups.show', $data->id) }}" class="btn btn-small btn-primary">Nariu sarasas</a>
                                      <a class="btn btn-small btn-warning">Redaguoti</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
</div>
@endsection
