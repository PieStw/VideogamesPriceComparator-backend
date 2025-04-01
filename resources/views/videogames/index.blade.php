@extends('layouts.master')
@section('content')

<div class="container my-4">
    <form action="{{ route('videogames.searchVideogames') }}" method="GET" class="d-flex justify-content-center mb-5">
        @csrf
        <div class="input-group w-50">
            <input type="text" name="search" class="form-control" placeholder="Cerca un videogame..." aria-label="Search" id="search">
            <button class="btn btn-outline-success" type="submit" id="button-addon2">Cerca</button>
        </div>
    </form>
</div>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Lista Videogiochi</h2>
        <a href="{{ route('videogames.create') }}" class="btn btn-success">➕ Aggiungi Videogioco</a>
    </div>

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th colspan="7" class="text-center">Videogames</th>
            </tr>
        </thead>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Titolo</th>
                <th scope="col">Anno di uscita</th>
                <th scope="col">Rating</th>
                <th scope="col">Dettaglio</th>
                <th scope="col">Modifica</th>
                <th scope="col">Elimina</th>
            </tr>
        </thead>
        <tbody>
            @foreach($videogames as $videogame)
                <tr>
                    <th scope="row">{{ $videogame->id }}</th>
                    <td>{{ $videogame->title }}</td>
                    <td>{{ $videogame->release_date }}</td>
                    <td>{{ $videogame->rating }}</td>
                    <td><a href="{{ route('videogames.show', $videogame->id) }}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Dettagli">Dettaglio</a></td>
                    <td><a href="{{ route('videogames.edit', $videogame->id) }}" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Modifica">Modifica</a></td>
                    <td>
                        <form action="{{ route('videogames.destroy', $videogame->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Sei sicuro di voler eliminare questo videogame?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Elimina">Elimina</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

