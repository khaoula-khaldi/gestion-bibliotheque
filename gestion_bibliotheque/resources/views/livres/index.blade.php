<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Liste des Livres</title>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        a, button {
            padding: 5px 10px;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }
        .edit {
            background-color: orange;
            color: white;
        }
        .delete {
            background-color: red;
            color: white;
        }
        .add {
            background-color: green;
            color: white;
            margin-bottom: 10px;
            display: inline-block;
        }
    </style>
</head>
<body>

<h1>Liste des Livres</h1>

<!-- ✅ message success -->
@if(session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif

<!-- ➕ Ajouter -->
<a href="{{ route('livres.create') }}" class="add">+ Ajouter un livre</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>ISBN</th>
            <th>Année</th>
            <th>Type</th>
            <th>Prix</th>
            <th>Disponible</th>
            <th>Quantité</th>
            <th>Auteur</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach($livres as $livre)
        <tr>
            <td>{{ $livre->id }}</td>
            <td>{{ $livre->titre }}</td>
            <td>{{ $livre->isbn }}</td>
            <td>{{ $livre->annee }}</td>
            <td>{{ $livre->type }}</td>
            <td>{{ $livre->prix }}</td>
            <td>{{ $livre->disponible ? 'Oui' : 'Non' }}</td>
            <td>{{ $livre->quantite }}</td>
            <td>{{ $livre->auteur_id }}</td>

            <td>
                <!-- ✏️ Modifier -->
                <a href="{{ route('livres.edit', $livre->id) }}" class="edit">
                    Modifier
                </a>

                <!-- 🗑️ Supprimer -->
                <form action="{{ route('livres.destroy', $livre->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="delete"
                        onclick="return confirm('Tu es sûr de supprimer ce livre ?')">
                        Supprimer
                    </button>

                    <a href="{{ route('livres.show', $livre->id) }}">
                        Voir
                    </a>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>