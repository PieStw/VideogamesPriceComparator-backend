@extends('layouts.master')
@section('content')


<div>
    <form action="{{ route("videogames.searchVideogames") }}" method="GET" class="d-flex justify-content-center mb-4">
        @csrf

        <label for="search" class="form-label me-2">Cerca un videogame:</label>
        <input type="text" name="search" class="form-control me-2" placeholder="Cerca un videogame..." aria-label="Search" id="search">
        <button class="btn btn-outline-success" type="submit">Cerca</button>
    </form>
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
                <th scope="row">{{$videogame->id}}</th>
                <td>{{ $videogame->title }}</td>
                <td>{{ $videogame->release_date }}</td>
                <td>{{ $videogame->rating }}</td>
                <td><a href="/videogames/{{ $videogame->id }}" class="btn btn-primary">Dettaglio</a></td>
                <td><a href="{{ route('videogames.edit', $videogame->id) }}" class="btn btn-warning">Modifica</a></td>
                <td>
                    <form action="{{ route('videogames.destroy', $videogame->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Elimina</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>


    

@endsection

