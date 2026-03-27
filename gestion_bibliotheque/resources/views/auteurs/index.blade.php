
<div class="container">
    <h1>Liste des Auteurs</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('Auteurs.create') }}" class="btn btn-primary mb-3">Ajouter un Auteur</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de Naissance</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($auteurs as $auteur)
                <tr>
                    <td>{{ $auteur->id }}</td>
                    <td>{{ $auteur->nom }}</td>
                    <td>{{ $auteur->prenom }}</td>
                    <td>{{ $auteur->date_naissance }}</td>
                    <td>
                        <a href="{{ route('Auteurs.show', $auteur->id) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('Auteurs.edit', $auteur->id) }}" class="btn btn-warning btn-sm">Editer</a>

                        <form action="{{ route('Auteurs.destroy', $auteur->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Voulez-vous vraiment supprimer cet auteur ?')" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
