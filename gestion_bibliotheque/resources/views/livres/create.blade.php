<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un livre</title>
</head>
<body>

<h1>Ajouter un livre</h1>

<form method="POST" action="{{ route('livres.store') }}" >
    @csrf

    <div>
        <label for="titre">Titre :</label>
        <input type="text" name="titre" id="titre" required>
    </div>

    <div>
        <label for="isbn">ISBN :</label>
        <input type="text" name="isbn" id="isbn" required>
    </div>

    <div>
        <label for="annee">Année :</label>
        <input type="number" name="annee" id="annee" required>
    </div>

    <select name="type" required>
        <option value="free">Free</option>
        <option value="premium">Premium</option>
    </select>

    <div>
        <label for="description">Description :</label>
        <textarea name="description" id="description" required></textarea>
    </div>

    <div>
        <label for="prix">Prix :</label>
        <input type="number" step="0.01" name="prix" id="prix" required>
    </div>

    <div>
        <label for="disponible">Disponible :</label>
        <select name="disponible" id="disponible" required>
            <option value="1">Oui</option>
            <option value="0">Non</option>
        </select>
    </div>

<div>
    <label for="quantite">Quantité :</label>
    <input type="number" name="quantite" id="quantite" required>
</div>

    <div>
        <label for="auteur_id">Auteur :</label>
        <input type="number" name="auteur_id" id="auteur_id" required>
        <!-- F futur, n9dro ndir select list mn table auteurs -->
    </div>

    <button type="submit">Ajouter</button>
</form>

</body>
</html>