@extends('layouts.app')

<script type="text/javascript">
  async function deleteMember(ID){
      const {value: group} = await Swal.fire({
        title: 'Patvirtinkite istrynima',
        showCancelButton: true,
        confirmButtonText: 'Patvirtinti',
        showLoaderOnConfirm: true,
        preConfirm: (value) => {
          console.log("Its working");
          $.ajax({
              url: '/members/${ID}/delete',
              type: 'GET',
              success: function(data) {
                if (data.status != 'OK'){
                    Swal.fire({
                      type: 'error',
                      title: 'Klaida!',
                      text: 'Atsitiko klaida',
                      footer: '<a href>Kodel yra susiduriama su sia problema?</a>'
                  });

                  console.log('FAILED');
                }else if(data.status == 'OK'){
                  Swal.fire({
                    type: 'success',
                    title: 'Pavyko!',
                    text: 'Narys sekmingai istrintas is sistemos',
                  });
                }
              }
            });
        }

      });
  }
  async function assignRFID(ID){
      const {value: RFID} = await Swal.fire({
        title: 'Priskirti RFID',
        text: 'Pridekite kortele ar apyranke prie skenerio pries tai paspaude ant lauko',
        input: 'text',
        showCancelButton: true,
        confirmButtonText: 'Patvirtinti',
        showLoaderOnConfirm: true,
        preConfirm: (value) => {
          console.log("Its working");
          $.ajax({
              url: '/rfid/store',
              type: 'POST',
              headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              data: {
                RFID: value,
                Owner: ID,
              },
              success: function(data) {
                console.log(value);
                if (data.status != 'OK'){
                    Swal.fire({
                      type: 'error',
                      title: 'Klaida!',
                      text: 'Atsitiko klaida',
                      footer: '<a href>Kodel yra susiduriama su sia problema?</a>'
                  });

                  console.log('FAILED');
                }else if(data.status == 'OK'){
                  Swal.fire({
                    type: 'success',
                    title: 'Pavyko!',
                    text: 'RFID irenginys priskirtas sekmingai!',
                  });
                }
              }
            });
        }

      });
  }
</script>

@section('content')
<div class="container">
@foreach($groups as $data)
    <div class="row justify-content-center">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h1 class="title" style="text-align: center;">{{$data->groupName}}</h1>
            </div>
            <div class="card-body">
                  <form method="POST" action="{{ action('GroupsController@update', $data->id) }}">
                        {{ csrf_field() }}
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputFname">Grupes pavadinimas</label>
                                <input type="text" name="groupName" class="form-control" id="inputFname" placeholder="Pavadinimas" value="{{ $data->groupName }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputBname">Treneris</label>
                                <input type="text" name="leader" class="form-control" id="inputBname" value="{{ $data->leader }}">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputBname">Aprasymas</label>
                                <textarea type="text" name="description" class="form-control" id="inputBname" placeholder="" value="{{ $data->description }}">{{ $data->description }}</textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Patvirtinti</button>
                        <a class="btn btn-danger" onclick="deleteMember({{$data->id}})">
                          <span class="icon icon-white" data-feather="trash"></span>
                        </a>
                    </form>
            </div>
          </div>
      </div>
    </div>
</div>
@endforeach
@endsection
