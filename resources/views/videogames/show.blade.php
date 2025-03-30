@extends('layouts.master')

@section('content')

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="row g-0">
            <!-- Copertina del videogioco -->
            <div class="col-md-4 d-flex align-items-center">
                <img src="{{ $videogame->image_url }}" class="img-fluid rounded-start w-100" alt="Copertina di {{ $videogame->title }}">
            </div>

            <!-- Informazioni del videogioco -->
            <div class="col-md-8">
                <div class="card-body">
                    <h1 class="card-title fw-bold">{{ $videogame->title }}</h1>
                    <p class="card-text text-muted"><strong>Data di Uscita:</strong> {{ $videogame->release_date }}</p>
                    <p class="card-text"><strong>Descrizione:</strong> {{ $videogame->description }}</p>
                    <p class="card-text"><strong>Rating:</strong> <span class="badge bg-warning text-dark fs-6">{{ $videogame->rating }}</span></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Sezione con generi e piattaforme -->
    <div class="row mt-4">
        <div class="col-md-6">
            <h4 class="fw-bold">Generi</h4>
            <div>
                @foreach($videogame->genres as $genre)
                    <span class="badge bg-primary fs-6 me-2">{{ $genre->name }}</span>
                @endforeach
            </div>
        </div>

        <div class="col-md-6">
            <h4 class="fw-bold">Piattaforme</h4>
            <div>
                @foreach($videogame->platforms as $platform)
                    <span class="badge bg-success fs-6 me-2"> {{ $platform->name }}</span>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Pulsante per tornare alla lista -->
    <div class="mt-4 text-center">
        <a href="{{ route('videogames.index') }}" class="btn btn-outline-secondary btn-lg">
            <i class="bi bi-arrow-left"></i> Torna alla lista
        </a>
    </div>
</div>

@endsection
