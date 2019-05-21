@extends('layouts.app')

@section('content')
{{-- <script type="text/javascript">
   async function confirmMember(signupID){
      const {value: group} = await Swal.fire({
        title: 'Select dance group',
        input: 'select',
        inputOptions: {
          @foreach($groups as $group)
          '{{$group->id}}': '{{$group->groupName}}',
          @endforeach
        },

        inputPlaceholder: 'Select a group',
        showCancelButton: true,
        confirmButtonText: 'Patvirtinti',
        showLoaderOnConfirm: true,
        preConfirm: (value) => {
          console.log("Its working");
          $.ajax({
              url: '/dancer/create',
              type: 'POST',
              headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              data: {
                signupID: signupID,
                groupID: value,
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
                    title: 'Priemimas pavyko!',
                    text: 'Registracijos prasymas buvo sekmingai patvirtintas',
                  });
                  location.reload();
                }
              }
            });
        }

      });
  }
  async function deleteMember(signupID){
      const {value: group} = await Swal.fire({
        title: 'Confirm your action',
        showCancelButton: true,
        confirmButtonText: 'Patvirtinti',
        showLoaderOnConfirm: true,
        preConfirm: (value) => {
          console.log("Its working");
          $.ajax({
              url: '/signups/delete',
              type: 'POST',
              headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              data: {
                id: signupID,
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
                    title: 'Istrintas sekmingai!',
                    text: 'Registracijos prasymas buvo sekmingai istrintas',
                  });
                  location.reload();
                }
              }
            });
        }

      });
  }
</script> --}}
{{-- <div class="">
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
                            @foreach ($signups as $data)
                                <tr>
                                    <td> {{ $data->id }} </td>
                                    <td> {{ $data->firstName }} </td>
                                    <td> {{ $data->lastName }} </td>
                                    <td> {{ $data->birthDate }} </td>
                                    <td> {{ $data->primaryPhone }} </td>
                                    <td>
                                        <a href="#confirm" class="link" onclick="confirmMember( {{$data->id}} );">Patvirtinti</a>
                                        <a href="#confirm" class="link" onclick="deleteMember( {{$data->id}} );">Istrinti</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
</div> --}}


@endsection
