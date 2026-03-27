<!DOCTYPE html>
<html>
<head>
    <title>Détails Livre</title>
</head>
<body>

<h1>Détails du Livre</h1>

<p><strong>Titre:</strong> {{ $livre->titre }}</p>
<p><strong>ISBN:</strong> {{ $livre->isbn }}</p>
<p><strong>Année:</strong> {{ $livre->annee }}</p>
<p><strong>Type:</strong> {{ $livre->type }}</p>
<p><strong>Description:</strong> {{ $livre->description }}</p>
<p><strong>Prix:</strong> {{ $livre->prix }}</p>
<p><strong>Disponible:</strong> {{ $livre->disponible ? 'Oui' : 'Non' }}</p>
<p><strong>Quantité:</strong> {{ $livre->quantite }}</p>
<p><strong>Auteur ID:</strong> {{ $livre->auteur_id }}</p>

<a href="{{ route('livres.index') }}">⬅ Retour</a>

</body>
</html>