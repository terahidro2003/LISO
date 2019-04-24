@extends('layouts.app')
<script type="text/javascript">

</script>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Studijos balansas</div>

                <div class="card-body">
                    <h2 class="title">{{$balance}} euru</h2>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Studijos balanso kitimai</div>

                <div class="card-body">
                    <canvas class="chart" id="balanceChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Studijos gaunamos pajamos</div>

                <div class="card-body">
                    <canvas class="chart" id="paymentsChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
