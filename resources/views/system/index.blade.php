@extends('layouts.app')

@section('content')

<div class="container">
    <div class="sectionHeader mb-4">
      <h1>Sistemos atnaujinimai</h1>
      {{-- {{ Breadcrumbs::render('members') }} --}}
    </div>
    <div class="justify-content-center">
      <div class="row">
        <div class="col-md-4">
          <div class="card big">
          <div class="card-header">
            <h2>Naujas atnaujinimas/versija</h2>
          </div>
          <div class="card-body">
            <form method="post" action="{{action('HomeController@newVersion')}}">
              {{csrf_field()}}
              <label>Versijos numeris</label>
              <input class="form-control" placeholder="v0.x" name="version">

              <label class="mt-3">Atnaujinimo skubumas</label>
              <input class="form-control" placeholder="Skubus/planuotas/kritinis" name="type">

              <label class="mt-3">Atnaujinta sistemos dalis</label>
              <input class="form-control" placeholder="Back-end/Front-end" name="part">

              <label class="mt-3">Darbus atliko</label>
              <input class="form-control" placeholder="UAB X" name="developer">

              <label class="mt-3">Atnaujinimai</label>
              <textarea class="form-control" placeholder="" name="description"></textarea>

              <label class="mt-3">Išspręsti trūkumai/problemos</label>
              <textarea class="form-control" placeholder="" name="problemsSolved"></textarea>

              <label class="mt-3">Naujovės</label>
              <textarea class="form-control" placeholder="" name="improved"></textarea>
              <button type="submit" class="mt-3 btn btn-primary">Isleisti atnaujinima</button>
            </form>
          </div>
        </div>
        </div>
        <div class="col-md-8">
          <div class="card big">
                <div class="card-header flex-inline">
                  <h2 class="vertical-align">Visos sistemos versijos</h2>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-borderless">
                        <thead>
                            <tr>
                                <th>Versija</th>
                                <th>Svarbumas</th>
                                <th>Tipas</th>
                                <th>Išspręsta</th>
                                <th>Pagerinta</th>
                                <th>Veiksmai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($updates as $data)
                                <tr>
                                    <td> {{ $data->version }} </td>
                                    <td> {{ $data->type }} </td>
                                    <td> {{ $data->part }}</td>
                                    <td> {{ $data->problemsSolved }} </td>
                                    <td>
                                        {{ $data->improved }}
                                    </td>
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
    </div>
</div>
@endsection
