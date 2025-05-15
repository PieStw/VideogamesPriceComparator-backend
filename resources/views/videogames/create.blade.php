@extends('layouts.master')

@section('content')

<div class="container mt-5">
    <div class="card shadow-lg p-4">
        <h2 class="text-center fw-bold">Aggiungi un Videogioco</h2>

        <form action="{{ route('videogames.store') }}" method="POST" class="mt-4">
            @csrf

            
            <div class="mb-3">
                <label for="title" class="form-label fw-bold">Titolo</label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                    value="{{ old('title') }}" required minlength="3" maxlength="255">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

           
            <div class="mb-3">
                <label for="release_date" class="form-label fw-bold">Data di Uscita</label>
                <input type="date" name="release_date" id="release_date" class="form-control @error('release_date') is-invalid @enderror"
                    value="{{ old('release_date') }}" required>
                @error('release_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

           
            <div class="mb-3">
                <label for="description" class="form-label fw-bold">Descrizione</label>
                <textarea name="description" id="description" rows="4" class="form-control @error('description') is-invalid @enderror"
                    required>{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

          
            <div class="mb-3">
                <label for="rating" class="form-label fw-bold">Rating</label>
                <input type="number" name="rating" id="rating" class="form-control @error('rating') is-invalid @enderror"
                    value="{{ old('rating') }}" min="0" max="10" step="0.1" required>
                @error('rating')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image_url" class="form-label fw-bold">Image URL</label>
                <input type="text" name="image_url" id="image_url" class="form-control @error('image_url') is-invalid @enderror"
                     required minlength="3" maxlength="255" value="{{ old('image_url') }}">
                @error('image_url')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

         
            <div class="mb-3">
                <label class="form-label fw-bold">Generi</label>
                <div class="d-flex flex-wrap">
                    @foreach($genres as $genre)
                        <div class="form-check me-3">
                            <input class="form-check-input" type="checkbox" name="genres[]" value="{{ $genre->id }}" id="genre{{ $genre->id }}"
                                {{ in_array($genre->id, old('genres', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="genre{{ $genre->id }}">{{ $genre->name }}</label>
                        </div>
                    @endforeach
                </div>
                @error('genres')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

          
            <div class="mb-3">
                <label class="form-label fw-bold">Piattaforme</label>
                <div class="d-flex flex-wrap">
                    @foreach($platforms as $platform)
                        <div class="form-check me-3">
                            <input class="form-check-input" type="checkbox" name="platforms[]" value="{{ $platform->id }}" id="platform{{ $platform->id }}"
                                {{ in_array($platform->id, old('platforms', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="platform{{ $platform->id }}">{{ $platform->name }}</label>
                        </div>
                    @endforeach
                </div>
                @error('platforms')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success btn-lg">Salva</button>
                <a href="{{ route('videogames.index') }}" class="btn btn-outline-secondary btn-lg">Annulla</a>
            </div>
        </form>
    </div>
</div>

@endsection
