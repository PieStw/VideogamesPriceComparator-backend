<div class="container mt-4">
    <div class="card">
        <div class="row g-0">
            <div class="col-md-4">
                <img src={{$videogame->image_url}} class="img-fluid rounded-start" alt="Copertina del videogioco">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h2 class="card-title">{{$videogame->title}}</h2>
                    <p class="card-text"><strong>Data di Uscita:</strong> {{$videogame->release_date}}</p>
                    <p class="card-text"><strong>Descrizione:</strong> {{$videogame->description}}</p>
                    <p class="card-text"><strong>Rating:</strong> {{$videogame->rating}}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <h4>Generi</h4>
            <ul class="list-group">
                @foreach($videogame->genres as $genre)
                    <li class="list-group-item">{{$genre->name}}</li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-6">
            <h4>Piattaforme</h4>
            <ul class="list-group">
                @foreach($videogame->platforms as $platform)
                    <li class="list-group-item">{{$platform->name}}</li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <a href="/videogames" class="btn btn-secondary">Torna alla lista</a>
        </div>

</div>