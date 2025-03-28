@extends('layouts.master')

@section('content')
<div class="container text-center">
    <h1>404</h1>
    <p>Oops! La pagina che stai cercando non esiste.</p>
    <a href="{{ url('/') }}" class="btn btn-primary">Torna alla Home</a>
</div>
@endsection
