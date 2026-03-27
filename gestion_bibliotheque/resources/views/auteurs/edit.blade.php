
<div class="container">
    <h1>Modifier Auteur</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('Auteurs.update', $auteur->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom', $auteur->nom) }}" required>
        </div>

        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" name="prenom" id="prenom" class="form-control" value="{{ old('prenom', $auteur->prenom) }}" required>
        </div>

        <div class="mb-3">
            <label for="date_naissance" class="form-label">Date de naissance</label>
            <input type="date" name="date_naissance" id="date_naissance" class="form-control" value="{{ old('date_naissance', $auteur->date_naissance) }}">
        </div>

        <div class="mb-3">
            <label for="biographie" class="form-label">Biographie</label>
            <textarea name="biographie" id="biographie" class="form-control">{{ old('biographie', $auteur->biographie) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('Auteurs.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
