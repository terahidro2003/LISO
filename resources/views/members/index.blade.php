@extends('layouts.app')

@section('content')


<div class="container">
    <div class="sectionHeader mb-4">
      <h1>Nariai</h1>
      {{ Breadcrumbs::render('members') }}
    </div>
    <div class="justify-content-center">
            <div class="card big">
                <div class="card-header flex-inline">
                  <h2 class="vertical-align">Visi nariai sistemoje</h2>
                  <div class="actionButtons">
                    <button class="btn btn-primary btn-small" onclick="addMember();">Prideti nauja nari</button>
                  </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-borderless">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Vardas</th>
                                <th>Pavarde</th>
                                <th>Gimimo data</th>
                                <th>Telefono numeris</th>
                                <th>Grupe</th>
                                <th>Veiksmai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($members as $data)
                                <tr>
                                    <td> {{ $data->id }} </td>
                                    <td> {{ $data->firstName }} </td>
                                    <td> {{ $data->lastName }} </td>
                                    <td> {{ $data->birthDate }} </td>
                                    <td> {{ $data->primaryPhone }} </td>
                                    <td>
                                        @isset($data->currentGroup)
                                        {{$data->currentGroup->groupName}}
                                        @endisset
                                        @empty($data->currentGroup)
                                        <label class="bg-label bg-label-warning">Nepriskirtas</label>
                                        @endempty
                                    </td>
                                    <td>
                                        <a class="link" href="{{ route('members.edit', $data->id) }}">Redaguoti</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
</div>


<script type="text/javascript">
    async function addMember(){
        Swal.mixin({
          input: 'text',
          confirmButtonText: 'Sekantis &rarr;',
          showCancelButton: true,
          progressSteps: ['1', '2', '3', '4', '5']
        }).queue([
            {
              title: 'Naujo nario sukurimas',
              text: 'Pateikite ir irasykite varda'
            },
            {
              title: 'Naujo nario sukurimas',
              text: 'Pateikite ir irasykite pavarde'
            },
            {
              title: 'Naujo nario sukurimas',
              text: 'Pateikite ir irasykite gimimo metus'
            },
            {
              title: 'Naujo nario sukurimas',
              text: 'Pateikite ir irasykite telefono numeri'
            },
            {
              title: 'Naujo nario sukurimas',
              text: 'Irasykite miesta'
            },
        ]).then((result) => {
          if (result.value) {
              $.ajax({
                      url: '/api/members/store',
                      type: 'POST',
                      headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      data: {
                        firstName: result.value[0],
                        lastName: result.value[1],
                        birthDate: result.value[2],
                        primaryPhone: result.value[3],
                        city: result.value[4],
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
@endsection
