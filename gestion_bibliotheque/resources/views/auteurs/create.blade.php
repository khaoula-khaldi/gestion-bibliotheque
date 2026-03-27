
<div class="container">
    <h1>Ajouter un Auteur</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('Auteurs.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" name="prenom" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="date_naissance" class="form-label">Date de Naissance</label>
            <input type="date" name="date_naissance" class="form-control">
        </div>

        <div class="mb-3">
            <label for="biographie" class="form-label">Biographie</label>
            <textarea name="biographie" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Ajouter</button>
        <a href="{{ route('Auteurs.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
