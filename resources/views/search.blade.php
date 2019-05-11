@extends('layouts.app')

@section('content')
<div class="container">
   <div class="sectionHeader mb-4">
      <h1>Paieska</h1>
      {{ Breadcrumbs::render('search') }}
    </div>
    <div class="justify-content-center">
      <div style="padding-left: 0 !important;" class="row mb-2">
        <div class="col-md-4 mt-2 mb-1">
          <label for="category" class="label">Rodomu rezultatu skaicius</label>
          <select class="form-control">
            <option value="">Nuo 1 iki 10</option>
            <option value="">Nuo 11 iki 25</option>
            <option value="">Nuo 26 iki 40</option>
            <option value="">40 ir daugiau</option>
          </select>
        </div>
        <div style="padding-left: 0 !important;" class="col-md-4 mt-2 mb-1">
          <label for="category" class="label">Pasirinkite kategorija</label>
          <select class="form-control">
            <option value="">Visi rezultatai</option>
            <option value="">Nariai</option>
            <option value="">Registracijos</option>
            <option value="">Grupes</option>
          </select>
        </div>
      </div>
          <div class="card big">
                <div class="card-header flex-inline">
                  <h2 class="vertical-align">Visos rastos grupes</h2>
                </div>
                <div class="card-body">
                    @if($groups->count() == 0)
                    <table class="table card-table table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Pavadinimas</th>
                                <th>Sukurta</th>
                                <th>Veiksmai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groups as $data)
                                <tr>
                                    <td> {{ $data->id }} </td>
                                    <td> {{ $data->groupName }} </td>
                                    <td> {{ $data->created_at }} </td>
                                    <td>
                                      -
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="alert alert-warning">
                        Rezultatu nerasta
                    </div>
                    @endif
                </div>
          </div>

            <div class="card big">
                <div class="card-header flex-inline">
                  <h2 class="vertical-align">Visi rasti nariai</h2>
                </div>
                <div class="card-body">
                    @if(!empty($members))
                    <table class="table card-table table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Vardas</th>
                                <th>Pavarde</th>
                                <th>Gimimo data</th>
                                <th>Istojo</th>
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
                                    <td> {{ $data->created_at }} </td>
                                    <td>
                                      <a href="{{ route('members.edit', $data->id) }}" class="btn btn-small btn-warning">Redaguoti</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="alert alert-warning">
                        Rezultatu nerasta
                    </div>
                    @endif
                </div>
            </div>

            <div class="card big">
                <div class="card-header flex-inline">
                  <h2 class="vertical-align">Visos rastos registracijos</h2>
                </div>
                <div class="card-body">
                    @if(!empty($signups))
                    <table class="table card-table table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Vardas</th>
                                <th>Pavarde</th>
                                <th>Gimimo data</th>
                                <th>Istojo</th>
                                <th>Veiksmai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($signups as $data)
                                <tr>
                                    <td> {{ $data->id }} </td>
                                    <td> {{ $data->firstName }} </td>
                                    <td> {{ $data->lastName }} </td>
                                    <td>
                                     {{ $data->birthDate }}
                                    </td>
                                    <td> {{ $data->created_at }} </td>
                                    <td>
                                      -
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="alert alert-warning">
                        Rezultatu nerasta
                    </div>
                    @endif
                </div>
            </div>
    </div>
</div>
@endsection
