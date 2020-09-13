@extends('adminlte::page')

@section('title', "Detalhes do perfil {$profile->name}")

@section('content_header')
    <h1>Detalhes do perfil <b>{{ $profile->name }}</b></h1>
@stop

@section('content')

@include('alerts')

    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $profile->name }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $profile->description }}
                </li>
            </ul>
            <form action="{{ route('profiles.destroy', $profile->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> DELETAR O PERFIL: {{ $profile->name }}</button>
            </form>
        </div>
    </div>
@endsection
