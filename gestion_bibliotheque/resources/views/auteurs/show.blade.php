

<div class="container">
    <h1>Détails de l'Auteur</h1>

    <ul class="list-group">
        <li class="list-group-item"><strong>Nom:</strong> {{ $auteur->nom }}</li>
        <li class="list-group-item"><strong>Prénom:</strong> {{ $auteur->prenom }}</li>
        <li class="list-group-item"><strong>Date de Naissance:</strong> {{ $auteur->date_naissance }}</li>
        <li class="list-group-item"><strong>Biographie:</strong> {{ $auteur->biographie }}</li>
    </ul>

    <a href="{{ route('Auteurs.index') }}" class="btn btn-secondary mt-3">Retour à la liste</a>
</div>
