@extends('layouts.app')

@section('content')

<div class="container">
    <div class="sectionHeader mb-4">
      <h1>RFID korteles ir irenginiai</h1>
      {{-- {{ Breadcrumbs::render('members') }} --}}
    </div>
    <div class="justify-content-center">
            <div class="card big">
                <div class="card-header flex-inline">
                  <h2 class="vertical-align">Visi RFID sistemoje</h2>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-borderless">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>RFID indent. num.</th>
                                <th>Savininkas</th>
                                <th>Praskenuota kartu</th>
                                <th>Busena</th>
                                <th>Veiksmai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rfids as $data)
                                <tr>
                                    <td> {{ $data->id }} </td>
                                    <td> {{ $data->RFID }} </td>
                                    <td> {{ $data->owner->firstName }} {{ $data->owner->lastName }} </td>
                                    <td> {{ $data->timesChecked }} </td>
                                    <td>
                                        @if($data->Status === 'ACTIVE')
                                            <label class="bg-label bg-label-success">AKTYVUS</label>
                                        @else
                                            <label class="bg-label bg-label-danger">NEAKTYVUS</label>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="link" href="">Redaguoti</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
</div>
<div id="convertJSTOPHP"></div>
@endsection
