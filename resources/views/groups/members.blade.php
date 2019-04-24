@extends('layouts.app')

@section('content')
<div class="container">
   <div class="sectionHeader mb-4">
      <h1>Grupes {{$groupName->groupName}} nariai</h1>
      {{ Breadcrumbs::render('groups') }}
    </div>
    <div class="justify-content-center">
            <div class="card big">
                <div class="card-header flex-inline">
                  <h2 class="vertical-align">Grupes nariai</h2>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Vardas</th>
                                <th>Pavarde</th>
                                <th>Gimimo data</th>
                                <th>Busena</th>
                                <th>Veiksmai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($members as $data)
                                <tr>
                                    <td> {{ $data->id }} </td>
                                    <td> {{ $data->firstName }} </td>
                                    <td> {{ $data->lastName }} </td>
                                    <td>
                                      {{ $data->birthDate }}
                                    </td>
                                    <td>
                                      @if($data->balance < 0)
                                      <label class="bg-label bg-label-danger">Skola</label>
                                      @else
                                      <label class="bg-label bg-label-success">Skolu nerasta</label>
                                      @endif
                                    </td>
                                    <td>
                                      <a href="{{ route('members.edit', $data->id) }}" class="btn btn-small btn-warning">Redaguoti</a>
                                      <a href="#" onclick="newPayment({{$data->id}})" class="btn btn-small btn-primary">Naujas mokejimas</a>
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
