@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h1>Errore</h1>
    <p>Si è verificato un errore inaspettato.</p>
    @if(isset($message))
        <p><strong>Errore:</strong> {{ $message }}</p>
    @endif
    <a href="{{ url('/') }}" class="btn btn-primary">Torna alla Home</a>
</div>
@endsection
