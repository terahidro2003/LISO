<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="{{ asset('css/public.css') }}" rel="stylesheet">

    <title>Sfinx registracija</title>
</head>
<body>
<section id="signup"></section>
<div class="signup-background"></div>
<div class="container uk-position-center">
  <div class="sfinx-signup">
    <form class="sfinx-signup-form" method="POST" action=" {{action('SignupsController@store')}} ">
     @csrf
     <div class="input-container">
        <span class="title">Registracija | Šokių studija SFINX</span>
      </div>
      <div class="row-class">
          <div class="input-container">
              <label class="label">Vardas</label>
              <input type="text" name="firstName" class="sfinx-input" placeholder="Pvz: Vardenis" value="{{ old('firstName') }}">
          </div>
          <div class="input-container">
              <label class="label">Pavardė</label>
              <input type="" name="lastName" class="sfinx-input " placeholder="Pvz: Pavardenis" value="{{ old('lastName') }}">
          </div>
      </div>
      <div class="row-class">
      <!-- <div class="input-container">
        <label class="label">Facebook vartotojo vardas</label>
      <input type="text" name="facebook" class="sfinx-input" placeholder="Pvz: vardenis.pavardenis">
      </div> -->
    </div>
      <div class="row-class">
      <div class="input-container">
          <label class="label">Telefono numeris</label>
          <input type="text" name="primaryPhone" class="sfinx-input " placeholder="Pvz: +3706xxxxxxx" value="{{ old('primaryPhone') }}">
      </div>
      <div class="input-container">
          <label class="label">Gimimo data</label>
          <input onkeyup="" type="date" id="birth-date" name="birthDate" class="sfinx-input " placeholder="Pvz: 2018-01-01" value="{{ old('birthDate') }}">
      </div>
      </div>
      <div class="input-container">
          <label class="label">Miestas</label>
          <select name="city" class="form-control">
            <option value="klaipeda" @if(old('birthDate') == 'klaipeda') checked @endif>Klaipėda</option>
            <option value="vilnius" @if(old('birthDate') == 'vilnius') checked @endif>Vilnius</option>
          </select>
      </div>
      <div class="row-class input-container">
          <span class="action" style="color: black;">
              Šokių pamokos tris kartus per savaitę | Treniruotės trukmė 1 val. | Mėnesinio abonemento kaina - 35 Eur | Daugiau informacijos telefonu: 860559977 arba 864955599
              Rekvizitai:
              VŠĮ „SFINKSAI''
              Į.k. 304632331
              Įmonės kodas: 304632331
              Sąsk. nr. LT497300010153915573
          </span>
          <button type="submit" class="btn-submit">Patvirtinti</button>
      </div>
    </form>
  </div>
</div>
</body>