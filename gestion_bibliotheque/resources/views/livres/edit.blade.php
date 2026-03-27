<h1>Modifier livre</h1>

<form method="POST" action="{{ route('livres.update', $livres->id) }}">
    @csrf
    @method('PUT')

    <input type="text" name="titre" value="{{ $livres->titre }}">
    <input type="text" name="isbn" value="{{ $livres->isbn }}">
    <input type="number" name="annee" value="{{ $livres->annee }}">

    <select name="type">
        <option value="free" {{ $livres->type == 'free' ? 'selected' : '' }}>Free</option>
        <option value="premium" {{ $livres->type == 'premium' ? 'selected' : '' }}>Premium</option>
    </select>

    <textarea name="description">{{ $livres->description }}</textarea>

    <input type="number" name="prix" value="{{ $livres->prix }}">

    <select name="disponible">
        <option value="1" {{ $livres->disponible ? 'selected' : '' }}>Oui</option>
        <option value="0" {{ !$livres->disponible ? 'selected' : '' }}>Non</option>
    </select>

    <input type="number" name="quantite" value="{{ $livres->quantite }}">
    <input type="number" name="auteur_id" value="{{ $livres->auteur_id }}">

    <button type="submit">Modifier</button>
</form>