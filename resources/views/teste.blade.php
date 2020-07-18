@extends('adminlte::page')

@section('title', 'Dashboard')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
<p>Welcome to this beautiful admin panel.</p>
<div class="row">
    <div class="form-group col-sm-12">
     <label for="" class="col-sm-2 control-label"></label>
        <div class="col-sm-4">
            <select name="country_id" id="country" data-default="{{ config('states-and-cities.default-country') }}"></select>
        </div><br>

        <div class="col-sm-4">
            <select name="state_id" id="state" data-default="{{ config('states-and-cities.default-state') }}">

            </select>
        </div><br>

        <div class="col-sm-4">
            <select name="city_id" id="city" data-default="{{ config('states-and-cities.default-city') }}"></select>
        </div><br>

        <div class="col-sm-4">
            <input name="postal_code" id="postal_code" data-autocomplete="true" data-mask="{{ config('states-and-cities.postal_code_mask') }}" type="text" }}">
        </div>

    </div>
</div>
@stop

@section('css')

@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<script src="{{url('//oss.maxcdn.com/jquery.mask/1.11.4/jquery.mask.min.js')}}"></script>
<script src="{{url('/vendor/StatesAndCities/js/blit-states-and-cities.js')}}"></script>
@stop
