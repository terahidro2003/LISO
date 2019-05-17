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
@foreach($dancer as $data)
  <div class="sectionHeader mb-4">
    <div style=" width: auto; height: auto; display: flex; flex-direction: row; justify-content: space-between;">
    <h1>{{$data->firstName}} {{$data->lastName}}</h1>
    <button class="btn btn-primary" onclick="newPayment({{$data->id}});" @if($data->VIP == 'yes') disabled @endif>
      <span class="icon icon-white" data-feather="dollar-sign"></span>
    </button>
    {{-- <img src="/vip.png" alt="Sis narys yra atleistas nuo mokesciu" width="90vw" height="auto" style="margin: 1px;"> --}}
  </div>
      {{ Breadcrumbs::render('member', $data->firstName, $data->lastName, $data->id) }}
      <div class="mt-2">
      	@if(strpos($data->primaryPhone, '370') == false)
      		@if(strpos($data->primaryPhone, '86') == false)
	      		<div class="alert alert-warning">
	      			Tikriausiai nurodytas klaidingas telefono numeris
	      		</div>
      		@endif
      	@endif
      </div>
  </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3 class="card-title">Nario anketa</h3></div>
                <div class="card-body">
                    <form method="POST" action="{{ action('DancerController@update', $data->id) }}">
                        {{ csrf_field() }}
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputFname">Vardas</label>
                                <input type="text" name="firstName" class="form-control" id="inputFname" placeholder="Vardenis" value="{{ $data->firstName }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputLname">Pavarde</label>
                                <input type="text" name="lastName" class="form-control" id="inputLname" placeholder="Vardenis" value="{{ $data->lastName }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputBname">Gimimo data</label>
                                <input type="date" name="birthDate" class="form-control" id="inputBname" value="{{ $data->birthDate }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputBname">Pagr. telefono numeris</label>
                                <input type="text" name="primaryPhone" class="form-control" id="inputBname" placeholder="Telefono numeris" value="{{ $data->primaryPhone }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputBname">Grupe</label>
                                <select class="form-control" name="group">
                                  @foreach($groups as $group)
                                    <option value="{{$group->id}}" @if ($data->group == $group->id) checked @endif>{{ $group->groupName }}</option>
                                  @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Patvirtinti</button>

                        <button class="btn btn-danger" onclick="deleteMember({{$data->id}})">
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
              <button class="btn btn-primary" onclick="assignRFID({{$data->id}});" @isset($data->rfid) disabled @endisset>Priskirti kortele</button>
              @isset($data->rfid)
              <button class="btn btn-danger" onclick="">
              	<span class="icon-white" data-feather="delete"></span>
              </button>
              @endisset
            </div>
          </div>
          <div class="card-body">
            @if($errors[0] == 1)
            <div class="alert alert-warning">Yra priskirta daugiau nei viena RFID kortele</div>
            @endif
            @isset($data->rfid)
            @if($data->rfid->Status == 'ACTIVE')
              <h3>Priskirtas RFID: {{$data->rfid->RFID}}</h3>
              <h3>Priskyrimo data: {{$data->rfid->created_at}}</h3>
              <h3>RFID panaudota: {{$data->rfid->timesChecked}}</h3>
            @else
              <div class="alert alert-danger">Kortele ({{$data->rfid->RFID}}) yra priskirta, taciau ji yra neaktyvi</div>
            @endif
            @endisset
            @empty($data->rfid)
            <div class="alert alert-warning">Joks RFID irenginys nera priskirtas</div>
            @endempty
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
                              @foreach ($payments as $payment)
                                  <tr>
                                      <td> {{ $payment->id }} </td>
                                      <td> {{ $payment->price }} </td>
                                      <td> {{ $payment->description }} </td>
                                      <td> {{ $payment->created_at }} </td>
                                      <td>-</td>
                                  </tr>
                              @endforeach
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
                              @foreach ($data->entries as $entrie)
                                  <tr>
                                      <td> {{ $entrie->id }} </td>
                                      <td> {{ $entrie->created_at }} </td>
                                      <td> {{ $entrie->RFID }} </td>
                                  </tr>
                              @endforeach
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
@endforeach
@endsection
