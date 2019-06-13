@extends('layouts.auth')
@section('content')
<div class="container login-screen">
    <div class="row justify-content-center mb-5">

    </div>
    <div class="row h-80 justify-content-center">
        <div class="col-md-5 flex-column">
          <div class="logo">
            <svg id="logo" style="width: auto !important;min-height:120px;" viewBox="0 0 271 88">
              <rect id="Rectangle_1" data-name="Rectangle 1" width="88" height="88" fill="#4062bb"/>
              <g id="Group_1" data-name="Group 1" transform="translate(28 28)">
                <path id="Path_1" data-name="Path 1" d="M0,0H32V32H0Z" fill="none"/>
                <path id="Path_2" data-name="Path 2" d="M4.444,17.444h8.667A1.449,1.449,0,0,0,14.556,16V4.444A1.449,1.449,0,0,0,13.111,3H4.444A1.449,1.449,0,0,0,3,4.444V16A1.449,1.449,0,0,0,4.444,17.444ZM4.444,29h8.667a1.449,1.449,0,0,0,1.444-1.444V21.778a1.449,1.449,0,0,0-1.444-1.444H4.444A1.449,1.449,0,0,0,3,21.778v5.778A1.449,1.449,0,0,0,4.444,29Zm14.444,0h8.667A1.449,1.449,0,0,0,29,27.556V16a1.449,1.449,0,0,0-1.444-1.444H18.889A1.449,1.449,0,0,0,17.444,16V27.556A1.449,1.449,0,0,0,18.889,29ZM17.444,4.444v5.778a1.449,1.449,0,0,0,1.444,1.444h8.667A1.449,1.449,0,0,0,29,10.222V4.444A1.449,1.449,0,0,0,27.556,3H18.889A1.449,1.449,0,0,0,17.444,4.444Z" fill="rgba(255,255,255,0.5)"/>
              </g>
              <text id="DSMS" transform="translate(107 38)" fill="rgba(0,0,0,0.69)" font-size="28" font-family="Montserrat-SemiBold, Montserrat" font-weight="600" opacity="0.798"><tspan x="0" y="0">DSMS</tspan></text>
              <text id="Created_powered_by_SpruceBird_Innovations" data-name="Created &amp; powered by SpruceBird Innovations" transform="translate(107 46)" fill="rgba(0,0,0,0.44)" font-size="9" font-family="Montserrat-SemiBold, Montserrat" font-weight="600"><tspan x="0" y="9">Created &amp; powered by SpruceBird </tspan><tspan x="0" y="20">Innovations</tspan></text>
            </svg>
          </div>
        </div>
        <div class="col-md-5">
            <div class="card login-card">
                <div class="card-header">
                  <h2>Administratoriaus vartotojo paskyros patvirtinimas</h2>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row">
                              <label for="email" class="col-md-12 col-form-label text-md-left">El. pašto adresas</label>

                              <div class="col-md-12">
                                  <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                  @if ($errors->has('email'))
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('email') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-12 col-form-label text-md-left">Sugalvokite slaptažodi</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-12">
                                <button type="submit" class="btn btn-primary w-100">
                                    Registruotis
                                </button>

                                {{-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        Priminti slaptažodį
                                    </a>
                                @endif --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
