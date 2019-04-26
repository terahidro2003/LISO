@extends('layouts.app')

@section('content')


<div class="container">
    <div class="sectionHeader mb-4">
      <h1>Mokejimai</h1>
    </div>
    <div class="justify-content-center">
            <div class="card big">
                <div class="card-header flex-inline">
                  <h2 class="vertical-align">Visi atlikti mokejimai</h2>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-borderless">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Vardas, pavarde</th>
                                <th>Grupe</th>
                                <th>Suma</th>
                                <th>Data ir laikas</th>
                                <th>Veiksmai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $data)
                                <tr>
                                    <td> {{ $data->id }} </td>
                                    <td>
                                      <a class="link" href="{{ route('members.edit', $data->id) }}">
                                         {{ $data->Owner->firstName }}
                                         {{ $data->Owner->lastName }}
                                      </a>
                                    </td>
                                    <td> {{ $data->Owner->currentGroup->groupName }} </td>
                                    <td> {{ $data->price }} </td>
                                    <td> {{ $data->created_at }} </td>
                                    <td>
                                        -
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
